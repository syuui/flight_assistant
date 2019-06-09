<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use PhpParser\Node\Expr\Cast\String_;
use Cake\I18n\Date;
const FLIGHT_SCHEDULE_HTTP_URL = 'https://flights.ctrip.com/domestic/schedule/#.html';
const REAL_FLIGHT_INFO_HTTP_URL = 'https://flights.ctrip.com/actualtime/fno--#FNO#-#YYYYMMDD#.html';

if (file_exists(dirname(__FILE__) . DS . 'simple_html_dom.class.php')) require_once dirname(__FILE__) . DS . 'simple_html_dom.class.php';


class PageSpiderComponent extends Component
{

    public function getHttpUrl($flightNo)
    {
        return str_replace('#', $flightNo, FLIGHT_SCHEDULE_HTTP_URL);
    }

    /**
     * 返回HTTP_URL.
     *
     * 根据输入值返回携程相关页面的URL.<br>
     * <nl>
     * <li>如果输入值是字符串，且以ｈｔｔｐ开头，则直接返回该字符串。</li>
     * <li>如果输入值是字符串，但不以ｈｔｔｐ开头，则认为其是航班号。</li>
     * <li>如果输入值是数组，其中包含以下键：
     * <nl>
     * <li>url:直接返回</li>
     * <li>flight_no:以其为航班号生成URL</li>
     * </nl>
     * </nl>
     *
     * @param mixed $var
     *            URL或者航班号
     * @return NULL|string HTML
     */
    public function getFlightInfoWebPageHtmlText($var)
    {
        $url = null;
        
        // 输入是字符串的情况下
        if (is_string($var)) {
            // 如果以http开头，则直接就是url;否则认为输入是航班号码。
            if ('http' === substr($var, 0, 4)) $url = $var;
            else $url = str_replace('#', $var, FLIGHT_SCHEDULE_HTTP_URL);
        } elseif (is_array($var)) {
            if (array_key_exists('url', $var)) $url = $var['url'];
            elseif (array_key_exists('flight_no', $var)) $url = str_replace('#', $var['flight_no'], FLIGHT_SCHEDULE_HTTP_URL);
        }
        $this->log(__('Access URL {0}', $url), 'debug');
        if (empty($url)) return null;
        
        $htmlText = file_get_contents($url);
        $htmlText = iconv('GBK', 'utf-8', $htmlText);
        
        return $htmlText;
    }

    /**
     *
     * @param unknown $fno            
     * @param unknown $date            
     * @return NULL|string
     */
    public function getRealFlightInfoWebPageHtmlText(String_ $fno = null, $date = null)
    {
        if (is_object($date)) {
            if ($date instanceof \DateTime) {
                $date = date("YYYYMMDD", $date->getTimestamp());
            } elseif (is_string($date)) {
                if (!(8 === strlen($date) && preg_match('/^%d{8}$/', $date))) return null;
            }
        }
        
        $url = str_replace('#FNO#', $fno, REAL_FLIGHT_INFO_HTTP_URL);
        $url = str_replace('#YYYYMMDD#', $date, $url);
        
        if (empty($url)) return null;
        
        $htmlText = file_get_contents($url);
        $htmlText = iconv('GBK', 'utf-8', $htmlText);
        
        return $htmlText;
    }

    /**
     *
     *
     *
     *
     * <h2>php的DOMDocument读取HTML中文乱码问题</h2>
     * <h3>问题</h3>
     * 对网页HTML进行简单信息提取，这里不使用正则而使用 PHP 内建对象 DOMDocument 来做分析。
     * 在读取 HTML 片段<div id='chinese'>我是中文</div> 时，出现中文乱码。
     *
     * <h3>问题重现</h3>
     * 一段 HTML如下：
     *
     * &lt;p class='particle'&gt;
     * &lt;div id='chinese'&gt;我是中文&lt;/div&gt;
     * &lt;/p&gt;
     * PHP代码如下：
     *
     * $doc = new DOMDocument();
     * @$doc->loadHTML($html); // 这里直接$html变量代替
     * $chinese = $doc->getElementById('chinese');
     * $result = $doc->saveHTML($chinese);
     * print_r($result);
     * 输出结果出现不可读乱码。
     *
     * 解决
     * 由于 DOMDocument 的 loadHTML 会遵循 w3c 标准去识别，HTML 片段 缺少 meta 编码标签，所以出现乱码，可通过增加编码标签来修正。 <br>
     * $hackEncoding = '&lt;?xml encoding="UTF-8"&gt;';
     * $doc = new DOMDocument();
     * @$doc->loadHTML($hackEncoding . $html); // 这里带上encode
     * 注：网站不标准时会报 warning 错误，可使用 @ 来屏蔽错误
     *
     * 参考：
     *
     * @link : http://php.net/domdocument.loadhtml#95251
     *      
     *      
     *      
     * @param unknown $var            
     * @return NULL|NULL[]
     */
    public function getFlightInfoFromWebPage($var)
    {
        $doc = new \DOMDocument();
        $hackEncoding = '<?xml encoding="UTF-8">';
        $result = [];
        $this->log(__('Flight Number {0}', $var), 'debug');
        $htmlText = $this->getFlightInfoWebPageHtmlText($var);
        
        mb_ereg_search_init($htmlText, '<table(?:.*?)>(?:.*?)</table>');
        $m = mb_ereg_search();
        
        if (!$m) return null;
        else {
            $m = mb_ereg_search_getregs(); // get first result
            do {
                $m = $m[0];
                
                $doc->loadHTML($hackEncoding . $m);
                // 航班号，起降时间
                $elements = $doc->getElementsByTagName('td');
                
                foreach ($elements as $element) {
                    $className = $element->getAttribute('class');
                    switch ($className) {
                        case 'flight_logo':
                            break;
                        case 'depart':
                            foreach ($element->childNodes as $c) {
                                if ('strong' === $c->nodeName) {
                                    $result['depart_time'] = trim($c->textContent);
                                }
                                if ('div' === $c->nodeName) {
                                    $result['depart_terminal'] = trim($c->textContent);
                                }
                            }
                            break;
                        case 'arrive':
                            foreach ($element->childNodes as $c) {
                                if ('strong' === $c->nodeName) {
                                    $result['arriv_time'] = trim($c->textContent);
                                }
                                if ('div' === $c->nodeName) {
                                    $result['arriv_terminal'] = trim($c->textContent);
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
                $m = mb_ereg_search_regs(); // get next result
            } while ($m);
        }
        return $result;
    }

    public function getRealFlightInfoFromWebPage($flight = null, $date = null)
    {
        $doc = new \DOMDocument();
        $hackEncoding = '<?xml encoding="UTF-8">';
        $result = [];
        $htmlText = $this->getFlightInfoWebPageHtmlText($var);
        
        mb_ereg_search_init($htmlText, '<table(?:.*?)>(?:.*?)</table>');
        $m = mb_ereg_search();
        
        if (!$m) return null;
        else {
            $m = mb_ereg_search_getregs(); // get first result
            do {
                $m = $m[0];
                
                $doc->loadHTML($hackEncoding . $m);
                // 航班号，起降时间
                $elements = $doc->getElementsByTagName('td');
                
                foreach ($elements as $element) {
                    $className = $element->getAttribute('class');
                    switch ($className) {
                        case 'flight_logo':
                            break;
                        case 'depart':
                            foreach ($element->childNodes as $c) {
                                if ('strong' === $c->nodeName) {
                                    $result['depart_time'] = trim($c->textContent);
                                }
                                if ('div' === $c->nodeName) {
                                    $result['depart_terminal'] = trim($c->textContent);
                                }
                            }
                            break;
                        case 'arrive':
                            foreach ($element->childNodes as $c) {
                                if ('strong' === $c->nodeName) {
                                    $result['arriv_time'] = trim($c->textContent);
                                }
                                if ('div' === $c->nodeName) {
                                    $result['arriv_terminal'] = trim($c->textContent);
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
                $m = mb_ereg_search_regs(); // get next result
            } while ($m);
        }
        return $result;
    }
}