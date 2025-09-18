<?php
namespace app\commands;

use yii\console\Controller;
use Yii;
use app\models\User;

class UserController extends Controller
{
    public function actionHashPasswords()
    {
        $users = User::find()->all();

        foreach ($users as $u) {
            $name = strstr($u->email, '@', true);
            if (!$name) {
                echo "Pass (bad email): {$u->email}\n";
                continue;
            }

            $plain = 'hello' . $name;
            $u->password_hash = Yii::$app->security->generatePasswordHash($plain);

            if (empty($u->auth_key)) {
                $u->auth_key = Yii::$app->security->generateRandomString();
            }

            if ($u->save(false)) {
                echo "OK: {$u->email} (password: {$plain})\n";
            } else {
                echo "FAIL: {$u->email}\n";
            }
        }

        echo "Ready!\n";
    }
}
