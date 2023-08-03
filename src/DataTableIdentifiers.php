<?php

namespace Chromatic\OrangeDam;

/**
 * The valid identifier properties for the DataTable API.
 *
 * @see https://example.orangelogic.com/API/DataTable/v2.2/Documents.All:Read
 */
enum DataTableIdentifiers: string
{
    case SYSTEM_ID = 'CoreField.Identifier';
    case RECORD_ID = 'RecordID';
    case CLIENT_ID = 'CoreField.Id_Client';
    case OTHER_NUMBER = 'CoreField.OtherNum';
    case ORIGINAL_FILE_NAME = 'CoreField.OriginalFileName';
    case ORIGINAL_VERSION = 'CoreField.DO_OriginalVersion';
}
