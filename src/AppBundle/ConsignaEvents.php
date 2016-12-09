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


namespace AppBundle;


final class ConsignaEvents
{
    const FILE_DOWNLOADED = 'consigna.file.downloaded';

    const FILE_PRECREATE = 'consigna.file.precreate';

    const FILE_SHARED = 'consigna.file.shared';

    const FILE_UPLOADED = 'consigna.file.uploaded';

    const FOLDER_CREATED = 'consigna.folder.created';

    const FOLDER_DELETED = 'consigna.folder.delete';

    const FOLDER_PREDELETE = 'consigna.folder.predelete';

    const FOLDER_SHARED = 'consigna.folder.shared';

    const ORGANIZATION_ENABLED = 'consigna.organization.enabled';

    const ORGANIZATION_DISABLED = 'consigna.organization.disabled';

    const USER_PRE_CREATED = 'consigna.user.precreated';
}