<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 22:28.
 */

namespace AppBundle\Event;

final class ConsignaEvents
{
    /**
     * The CHECK_PASSWORD_SUCCESS event occurs when the user sends the right password.
     */
    const CHECK_PASSWORD_SUCCESS = 'consigna.password.success';

    /**
     * The FILE_ACCESS_SUCCESS event occurs when access has been granted to one file.
     */
    const FILE_ACCESS_SUCCESS = 'consigna.file.access.success';

    /**
     * The FILE_CHANGE_PASSWORD event occurs when a new password is submmited.
     */
    const FILE_CHANGE_PASSWORD = 'consigna.file.change.password';

    /**
     * The FILE_DELETE_ERROR event occurs when the file couldn't be deleted.
     */
    const FILE_DELETE_ERROR = 'consigna.file.delete.error';

    /**
     * The FILE_DELETE_SUCCESS event occurs when the file could be deleted.
     */
    const FILE_DELETE_SUCCESS = 'consigna.file.delete.success';

    /**
     * The FILE_DOWNLOAD_SUCCESS event occurs when the file has been downloaded.
     */
    const FILE_DOWNLOAD_SUCCESS = 'consigna.file.download.success';

    /**
     * The FILE_NEW_SUCCESS event occurs when a new file has been created.
     */
    const FILE_NEW_SUCCESS = 'consigna.file.new';

    /**
     * The FILE_UPLOAD_SUCCESS event occurs when the file has been uploaded.
     */
    const FILE_UPLOAD_SUCCESS = 'consigna.file.uploaded.success';

    /**
     * The FOLDER_ACCESS_SUCCESS event occurs when access has been granted to one folder.
     */
    const FOLDER_ACCESS_SUCCESS = 'consigna.folder.access.success';

    /**
     * The FOLDER_CHANGE_PASSWORD event occurs when a new password is submmited.
     */
    const FOLDER_CHANGE_PASSWORD = 'consigna.folder.change.password';

    /**
     * The FOLDER_DELETE_ERROR event occurs when the folder couldn't be deleted.
     */
    const FOLDER_DELETE_ERROR = 'consigna.folder.delete.error';

    /**
     * The FOLDER_DELETE_SUCCESS event occurs when the folder could be deleted.
     */
    const FOLDER_DELETE_SUCCESS = 'consigna.folder.delete.success';

    /**
     * The FOLDER_NEW_SUCCESS event occurs when a new folder has been created.
     */
    const FOLDER_NEW_SUCCESS = 'consigna.folder.new.success';

    /**
     * The FOLDER_UPDATE_SUCCESS event occurs when the folder configuration has been updated.
     */
    const FOLDER_UPDATE_SUCCESS = 'consigna.folder.update.success';
}
