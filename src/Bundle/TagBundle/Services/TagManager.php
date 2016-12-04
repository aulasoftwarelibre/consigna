<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bundle\TagBundle\Services;

use Bundle\TagBundle\Entity\Intefaces\TagInterface;
use Component\Core\Services\ObjectDirector;

class TagManager
{
    /**
     * @var ObjectDirector
     */
    private $tagDirector;

    public function __construct(
        ObjectDirector $tagDirector
    ) {
        $this->tagDirector = $tagDirector;
    }

    /**
     * @param array $tokens
     *
     * @return array
     */
    public function extractTagsFromTokens(array $tokens)
    {
        $tags = [];

        foreach ($tokens as $token) {
            if (null === ($tag = $this->tagDirector->findOneBy(['name' => $token]))) {
                /** @var TagInterface $tag */
                 $tag = $this->tagDirector->create();
                $tag->setName($token);
            }
            $tags[] = $tag;
        }

        $this->tagDirector->save($tags);

        return $tags;
    }
}
