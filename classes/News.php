<?php

/**
 * A news article
 */
class News extends Model {

    /**
     * The subject of the news article
     * @var string
     */
    protected $subject;

    /**
     * The content of the news article
     * @var string
     */
    protected $content;

    /**
     * The creation date of the news article
     * @var TimeDate
     */
    protected $created;

    /**
     * The date the news article was last updated
     * @var TimeDate
     */
    protected $updated;

    /**
     * The ID of the author of the news article
     * @var int
     */
    protected $author;

    /**
     * The status of the news article
     * @var string
     */
    protected $status;

    /**
     * The name of the database table used for queries
     */
    const TABLE = "news";

    /**
     * @see Model::getColumns()
     */
    protected function getColumns() {
        $columns = parent::getColumns();
        $columns["subject"] = Column::String("subject");
        $columns["content"] = Column::String("content");
        $columns["created"] = Column::DateTime("created");
        $columns["updated"] = Column::DateTime("updated");
        $columns["author"] = Column::Int("author");
        $columns["status"] = Column::String("status");

        return $columns;
    }

    /**
     * Get the subject of the news article
     * @return string
     */
    function getSubject() {
        return $this->subject;
    }

    /**
     * Get the author of the news article
     * @return Player
     */
    function getAuthor() {
        return new Player($this->author);
    }

    /**
     * Get the content of the article
     * @return string The raw content of the article
     */
    function getContent() {
        return $this->content;
    }

    /**
     * Get the time when the article was last updated
     * @return string The article's last update time in a human-readable form
     */
    function getUpdated() {
        return $this->updated->diffForHumans();
    }

    /**
     * Get the time when the article was submitted
     * @return string The article's creation time in a human-readable form
     */
    function getCreated() {
        return $this->created->diffForHumans();
    }

    /**
     * Get all the news entries in the database that aren't disabled or deleted
     * @return array An array of news IDs
     */
    public static function getNews() {
        return parent::fetchIdsFrom("status", array("disabled", "deleted"), "s", true, "ORDER BY updated DESC");
    }

}
