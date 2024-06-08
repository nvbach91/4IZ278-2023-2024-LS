<?php


function extractSubpath($absolutePath, $subdirectory) {
    $startIndex = strpos($absolutePath, $subdirectory);

    if ($startIndex !== false) {
        return substr($absolutePath, $startIndex);
    } else {
        return "Subdirectory not found in the absolute path";
    }
}
function handleFileUpload() : ?string
{
    try {
        if (isset($_FILES["bookImage"]) && $_FILES["bookImage"]["error"] == UPLOAD_ERR_OK) {
            $file = $_FILES["bookImage"];

            $fileSize = $file["size"];
            $fileTmpName = $file["tmp_name"];

            if ($fileSize > 5000000) {
                return null;
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                    $finfo->file($fileTmpName),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                    ),
                    true
                )) {
                return null;
            }
            $fileUrl =  __DIR__ . '/../images/'. sprintf('%s.%s',
                sha1_file($fileTmpName),
                $ext);

            if (!move_uploaded_file(
                $fileTmpName,
                $fileUrl
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            $trimmedPath = extractSubpath($fileUrl, "/images");
            return $trimmedPath;
        }
        else{
            return null;
        }
    }
    catch (RuntimeException $e) {
        echo $e->getMessage();
    }

}


?>
