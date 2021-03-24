<?php
/**
 * Image library
 */
namespace App\Libraries;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use InterventionImage;

/**
* This class handles uploading an image file to storage.
*/
class Image
{
    /** Upload folder */
    const UPLOAD_FOLDER   = 'uploads';

    /** Thumbnails information */
    const THUMBNAILS      = [
                                'filename' =>  'thumbnail',
                                'folder'   =>  'thumbnails',
                                'width'    =>  300,
                            ];

    /** Image medium size information */
    const MEDIUM =  [
                        'filename' =>  'medium',
                        'folder'   =>  'mediums',
                        'width'    =>  600,
                    ];

    /**
     * Upload an image to storage.
     *
     * @param     UploadedFile      $file       Uploaded file
     * @param     string            $module     Module name
     * @return    array                         Uploaded file information
     */
    public static function upload( UploadedFile $file, string $module )
    {

        $filename     = explode( '.', $file->getClientOriginalName() )[0] . '_' . date( 'His' ) . '.' . $file->extension();
        $fileInfo     = $file->move( public_path( 'storage/' . self::UPLOAD_FOLDER . '/' . $module ), $filename );

        $uploadedFile = [
                            'original'  => self::UPLOAD_FOLDER . '/' . $module . '/' . $filename,
                            'thumbnail' => self::createImage( $fileInfo, $module, self::THUMBNAILS ),
                            'medium'    => self::createImage( $fileInfo, $module, self::MEDIUM ),
                        ];

        return $uploadedFile;
    }

    /**
     * Create a new image.
     *
     * @param     File      $file        Uploaded file
     * @param     string    $module      Module name
     * @param     array     $fileInfo    File information for creating a new image
     * @return    string                 Image path
     */
    private static function createImage( File $file, string $module, array $fileInfo  )
    {
        $image       = InterventionImage::make( $file );
        $storagePath = 'storage/' . self::UPLOAD_FOLDER . '/' . $module . '/' . $fileInfo ['folder'] . '/';

        if( !is_dir( $storagePath ) ){
            mkdir( $storagePath, 0755 );
        }

        $filename =  explode( '.', $file->getFilename() )[0];
        $filename .= '_' . $fileInfo ['filename'] . '.' . $file->getExtension();
        $filepath = public_path( $storagePath );

        $image->resize( $fileInfo ['width'], null, function( $constraint ){
            $constraint->aspectRatio();
        })->save( $filepath . $filename );

        return self::UPLOAD_FOLDER . '/' . $module . '/'. $fileInfo ['folder'] . '/' . $filename;
    }

    /**
     * Delete an uploaded image.
     *
     * @param     array $images      Image path
     * @param     array $imageFields Image fields
     *
     * @return    void
     */
    public static function deleteImage( array $images, array $imageFields )
    {
        foreach( $images as $image ){
            foreach( $imageFields as $imageField ){

                $file_path = public_path( $image[ $imageField ] );

                if( is_file( $file_path ) ){
                    unlink( $file_path );
                }

            }
        }
    }

}