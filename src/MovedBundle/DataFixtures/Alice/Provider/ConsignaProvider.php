<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/4/15
 * Time: 9:05.
 */

namespace MovedBundle\DataFixtures\Alice\Provider;

class ConsignaProvider
{
    public function filename()
    {
        $files = array(
            'Solaris presentations: File Systems, Unicode, and Normalization.pdf',
            'NonNormalizingUnicodeCompositionAwareness - Subversion Wiki.pdf',
            'Windows Naming Conventions.pdf',
            'All-State Basketball: Boys Elite Squads.pdf',
            'Bruins basketball team still an inexperienced bunch.pdf',
            'The Nobel Prize in Literature 1999.pdf',
            'List of scheduled monuments in Sedgemoor.pdf',
            'List of cricketers who have carried the bat in international cricket.pdf',
            'My songs.zip',
            'My photos.zip',
        );

        return $files[array_rand($files)];
    }

    public function folder()
    {
        $folders = array(
            'Study Topics',
            'University Enrolment Documents',
            'Postgraduate Law Students',
            'Computer Science Course Presentation Photos',
            'Ubuntu packages',
            'Our holidays in Egypt 2015 (photos)',
            'Personal metadata from group ISL-213',
        );

        return $folders[array_rand($folders)];
    }

    public function tag()
    {
        $tag = array(
            'photos',
            'examples',
            'ppt',
            'powerpoint',
            'research',
            'urgent',
            'important',
            'computer science',
            'enrolment',
            'university',
            'spreadsheet',
            'document',
            'office',
            'private',
            'slides',
            'print',
            'download',
            'email',
            'images',
            'videos',
            'mp3',
            'tickets',
            'sound',
            'recipes',
            'zip',
            'memorandum',
            'report',
        );

        return $tag[array_rand($tag)];
    }
}
