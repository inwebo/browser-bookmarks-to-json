<?php

namespace Inwebo\Browser\Model;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExportCommand extends Command
{
    protected static $defaultName = 'app:export-bookmarks';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $jsonData = [];

        $iterator = new \GlobIterator('input/*.html');
        $output->writeln(sprintf('Reading %s html files', $iterator->count()),OutputInterface::OUTPUT_RAW);

        foreach ($iterator as $file) {
            $domDocument = new \DOMDocument();
            $loaded = $domDocument->loadHTMLFile($file->getRealPath(), LIBXML_NOERROR);

            if (true === $loaded) {
                $tags = $domDocument->getElementsByTagName('a');

                $output->writeln(sprintf('Parsing %s <a> nodes', $tags->length),OutputInterface::OUTPUT_RAW);

                $progressBar = new ProgressBar($output,  $tags->length);

                foreach ($tags as $tag) {
                    $bookmark = new Bookmark;

                    $bookmark->addDate      = (int)$tag->getAttribute('add_date');
                    $bookmark->lastModified = (int)$tag->getAttribute('last_modified');
                    $bookmark->title        = $tag->nodeValue;
                    $bookmark->href         = $tag->getAttribute('href');
                    $bookmark->icon         = $tag->getAttribute('icon');
                    $bookmark->iconUri      = $tag->getAttribute('icon_uri');

                    $jsonData[] = $bookmark;
                    $progressBar->advance();
                }
                $progressBar->finish();
                $output->writeln('');
            }
        }

        $output->writeln(sprintf('Writing %s bookmarks to json file', count($jsonData)));

        file_put_contents('output/data.json', json_encode($jsonData));
        $output->writeln('Done ');

        return Command::SUCCESS;
    }
}
