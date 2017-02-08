<?php
/**
 * Created by PhpStorm.
 * User: Elvis Lee
 * Date: 2016/12/18
 * Time: 1:17
 */

namespace MultiPay\classes\wepay;


class XmlTransfer
{
    /**
     * 将XML数据转换为对象
     * @param $xml  XmlTransfer
     * @return array
     */
    public function xml2Array($xml)
    {
        $obj = null;
        if (is_string($xml) && !empty($xml)) {
            $obj = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        }
        return (Array)$obj;
    }

    /**
     * 将数组转换成XML
     * @param $data
     * @return string
     */
    public function array2XML($data)
    {
        $xmlString = "";
        if (is_array($data) && !empty($data)) {
            $xmlString .= "<xml>";
            foreach ($data as $tag => $node)
            {
                $xmlString .= "<".$tag."><![CDATA[".$node."]]></".$tag.">";
            }
            $xmlString .= "</xml>";
        }
        return $xmlString;
    }
}