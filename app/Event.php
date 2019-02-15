<?php
namespace App;

/**
 * Class Event
 * @package App
 *
 * @author A. Suvorkin
 */
class Event
{
    /**
     * @var \DateTime Время публикации.
     */
    private $date;

    /**
     * @var string Заголовок.
     */
    private $title;

    /**
     * @var string Ссылка.
     */
    private $url;

    /**
     * Event constructor.
     * @param \DateTime $date
     * @param $title
     * @param $url
     */
    public function __construct(\DateTime $date, $title, $url)
    {
        $this->date = $date;
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * @return \DateTime Время публикации.
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string Заголовок.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string Ссылка.
     */
    public function getUrl()
    {
        return $this->url;
    }
}