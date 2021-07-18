# Convert browser's bookmarks HTML file to JSON

## Install project

### Composer
```bash
composer require inwebo/browser-bookmarks-to-json
```

### Git
```bash
git clone https://github.com/inwebo/browser-bookmarks-to-json.git
```

## Install dependencies
```bash
composer install
```

## Put your html files in `./input/` dir
Will parse all html files in input dir

## Execute command

```bash
 php -f export.php export:bookmarks
# Alias
php -f export.php eb
```

## You Should have a json object in output : data.json 

A serialized collection of Inwebo\Browser\Model\Bookmark models, see [Bookmark model](https://github.com/inwebo/browser-bookmarks-to-json/blob/master/Model/Bookmark.php)