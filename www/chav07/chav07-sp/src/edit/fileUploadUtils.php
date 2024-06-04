<?php


function extractSubpath($absolutePath, $subdirectory) {
    // Find the position where the subdirectory starts in the absolute path
    $startIndex = strpos($absolutePath, $subdirectory);

    // If the subdirectory is found, extract the substring from that position to the end
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

            $fileName = $file["name"];
            $fileSize = $file["size"];
            $fileType = $file["type"];
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

            var_dump($fileTmpName);
            var_dump($fileUrl);

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
