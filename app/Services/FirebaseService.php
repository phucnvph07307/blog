<?php

namespace App\Services;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;
class FirebaseService
{
    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromArray([
        "type" => "service_account",
        "project_id" => "notify-1f812",
        "private_key_id" => "5256f8f5381d3ff3d1e27ebffa72f2839e4907e7",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQD2Wl4uurtveGPU\nTSovylVtpQwQYQuA6Bt58cz1C3KJXonKd1J8ZF1K1JJ5z+iVWqUVhC+6m1ZdG2XH\n1W6K84S0YsWfkcDeu3V0JoO4v2qZUMBdjQ6Sf06zF1KqZnq4FQCsb6lNDGcDigNJ\nrdXe3dHHH/pSaIYD9yKNAWrGiUasw18Pf2lM2y282eQXj5X+iR3ddUNNS6blbKob\n/r8rgfPYqeCAm7rnQpfcGElVeqIY09vRhISoZjoaRdNQHkb43oeNTcGy3P0BXnef\n+ieKgrRBMaEgZA6SHRGboy18jyxFa1zndDAP6Tu7tCTVIp6v0AzsX5I9M3kSls/Z\nS9wvNyMBAgMBAAECggEAYgZsUoDIA19urbP0tOZ4XrQdXEkZODZjdH70FI91CFcf\nUfpvzoJrItL549GIVSGn7atXCJQ15b94nO7+2Ph0Fgj1ZPyst5P09P48TJ+SDaZ1\nnOP7Z+yTRqzhnl8/to7Y4URfJALq3JwmmcM7hj5Scj71rqPbq6lDTMNDFvPZtPUS\ntvZUBLCeka5dG6Rt1RRCE6u8+alkMHXowKMrvM8OxJRPZQD1GldMxQeJBj5IfIMo\nkKbdCrgyxz4/1Clj41LRpcK/jTAU+0HGMSPlu4v+E+EE0GcNdXyZZXHGJvPzL5Ox\ndi0UpE6hjKGWSftboiGSn2A2LqUMQZagdWFwgPWT1wKBgQD+prG36LU6BfL9et5o\n7lacHWQw/pIXeEatipskRDwheY+5cgvwR8Zq2p7MfC3W8XQWTAMmoKuqZyQJKSS2\ncvimovxt7pKCW/UFZkeTlNojflbi6pzhhS6G5vfffSNsZysIG1FcEEoCP4eLiR80\nL3mmgMKVF+mESouRIYQa9FONlwKBgQD3qGvjLqtcbGMzEOOt5Sn/vG0q0P3MhzTT\n4F8jvwVFIS5suWqUW3Cy4qL/dbgk2Qxx7XjKVE7XMRtjahiAgnSCK/RWqxRwuk39\nJSKdT4yt6ygh8M5Mq5tH74tXBasYtfWELg8jIPFW3882JUjFb2+J5OrTkA4eR+9E\nMhXFUdwXJwKBgCksAmfdtA9hjtv01ajZgB9VkTFqt2wcAjFky5idf6tZ4Cb3jX6X\n3DjCiBI/sZmjCEXinE/OgnLWojjo8gqdpB4tE+siO4XgIElzM/dkhbBfaOTfUeYU\nhmVBSqpTrTqFo6t33zunVo/ufZfN38GsO1r0ToGUkCjXdKFObfF9t1SZAoGAB+EG\n1ap1bzJPkZ9W7wBcbrNq8bLGcExY5Oi9fiCkpUdh97mKZ3/lPPuy3de77Qguui0o\n6571BymbynTkpKoB1OZbFqrIsrFqq8QTrteKDTpvA21q0sue3BIF59XZVKbtUbA5\ncQ+qPe5O5FUZVJawAL4UrnhlypbVSOEjCi0JiH8CgYEAwHYogL4ICj9ieYmTrQYJ\nAltN+zVShHgcWusi5fCOjWOcqkDDA20hs8gatsGFlwkDBeTD7i8NIKek295Dveu1\nxxE4KL71IOWp5VdLo8yrtqyHvHuH3QkqXGY/oTBUDnjmiMNOZqgVVlwkbVSIjKke\nzva9F3is89spUBXXPQrt5jg=\n-----END PRIVATE KEY-----\n",
        "client_id" => "111326938864830245549",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-vwgyc%40notify-1f812.iam.gserviceaccount.com",
        "database_url" => "https://notify-1f812.firebaseio.com",
        "client_email" => "firebase-adminsdk-vwgyc@notify-1f812.iam.gserviceaccount.com",
    ]);

        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(config('services.firebase.database_url'))
            ->create();
    }

    public function verifyPassword($email, $password)
    {
        try {
            $response = $this->firebase->getAuth()->verifyPassword($email, $password);
            return $response->uid;

        } catch(FirebaseEmailExists $e) {
            logger()->info('Error login to firebase: Tried to create an already existent user');
        } catch(Exception $e) {
            logger()->error('Error login to firebase: ' . $e->getMessage());
        }
        return false;
    }
}