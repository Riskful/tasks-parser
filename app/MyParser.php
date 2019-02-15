<?php

namespace App;

use Sunra\PhpSimple\HtmlDomParser;

/**
 * Class MyParser
 *
 * @author A. Suvorkin
 */
class MyParser
{
    /**
     * Целевой сайт.
     */
    const TARGET = 'http://www.bills.ru';

    /**
     * @var \simplehtmldom_1_5\simple_html_dom HTML дерево.
     */
    private $htmlDom;

    /**
     * @var Database База данных.
     */
    private $db;

    /**
     * @var array События.
     */
    private $events = [];

    /**
     * MyParser constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->htmlDom = HtmlDomParser::file_get_html(self::TARGET);
        $this->db = new Database();
        $this->save();
    }

    /**
     * Парсер даты.
     *
     * @param $date
     * @return \DateTime
     * @throws \Exception
     */
    public function parseDate($date)
    {

        $ruMonths = ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
        $enMonths = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

        $replaceMonth = str_replace($ruMonths, $enMonths, $date);
        $parseDate = date_parse_from_format('d F Y', $replaceMonth);

        $dateTime = new \DateTime();
        $dateTime->setDate($parseDate['year'], $parseDate['month'], $parseDate['day']);

        return $dateTime;
    }

    /**
     * Сохранение данных в БД.
     *
     * @throws \Exception
     */
    private function save()
    {
        $this->db->createTable();

        /** @var Event $event */
        foreach ($this->getEvents() as $event) {
            $query = "INSERT INTO `test`.`bills_ru_events`(`date`, `title`, `url`)
                      VALUES ('{$event->getDate()->format('Y-m-d H:i:s')}' ,
                      '{$event->getTitle()}', '{$event->getUrl()}')";
            $this->db->query($query);
        }
    }

    /**
     * Последние события.
     *
     * @return array
     * @throws \Exception
     */
    public function getEvents()
    {
        $table = $this->htmlDom->find('table.bizon_api_news_table', 0);

        $articles = $table->find('tr.bizon_api_news_row');


        foreach ($articles as $article) {

            $date = $article->find('td.news_date', 0)->plaintext;
            $link = $article->find('a', 0);
            $title = $link->plaintext;
            $url = $link->href;

            $this->events[] = new Event($this->parseDate($date), $title, $url);
        }

        return $this->events;
    }
}