<?php


use Phinx\Migration\AbstractMigration;

class AddGoogleRecaptchaSetting extends AbstractMigration
{
    public function up()
    {
        $fieldObject = [
            'field' => 'google_recaptcha_secret',
            'type' => 'string',
            'interface' => 'text-input',
            'sort' => '14'
        ];
        $collection = 'directus_settings';

        $checkSql = sprintf('SELECT 1 FROM `directus_fields` WHERE `collection` = "%s" AND `field` = "%s";', $collection, $fieldObject['field']);
        $result = $this->query($checkSql)->fetch();

        if (!$result) {
            $insertSqlFormat = 'INSERT INTO `directus_fields` (`collection`, `field`, `type`, `interface`, `sort`) VALUES ("%s", "%s", "%s", "%s", "%s");';
            $insertSql = sprintf($insertSqlFormat, $collection, $fieldObject['field'], $fieldObject['type'], $fieldObject['interface'],$fieldObject['sort']);
            $this->execute($insertSql);
        }

    }
}
