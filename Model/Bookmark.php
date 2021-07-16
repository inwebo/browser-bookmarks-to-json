<?php

namespace Inwebo\Browser\Model;

class Bookmark
{
    /** @var int timestamp */
    public int    $addDate;
    /** @var int timestamp */
    public int    $lastModified;
    public string $title;
    public string $href;
    /** @var string image's string representation  */
    public string $icon;
    /** @var string Uri to bookmark's favicon */
    public string $iconUri;
}
