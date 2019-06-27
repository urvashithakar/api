<?php


use Phinx\Migration\AbstractMigration;

class AddGoogleRecaptchaSetting extends AbstractMigration
{
    public function up()
    {
        $fieldObject = [
            'google_recaptcha_secret' => [
                'type' => 'string',
                'interface' => 'text-input',
                'sort' => '14',
                'width' => 'half'
            ],
            'google_recaptcha_site_key' => [
                'type' => 'string',
                'interface' => 'text-input',
                'sort' => '15',
                'width' => 'half'
            ],
        ];

        foreach ($fieldObject as $field => $options) {
            $this->addField($field, $options['type'], $options['interface'],$options['sort'],$options['width']);
        }
    }
    protected function addField($field, $type, $interface, $sort ,$width)
    {
        $collection = 'directus_settings';
        $checkSql = sprintf('SELECT 1 FROM `directus_fields` WHERE `collection` = "%s" AND `field` = "%s";', $collection, $field);
        $result = $this->query($checkSql)->fetch();

        if (!$result) {
            $insertSqlFormat = 'INSERT INTO `directus_fields` (`collection`, `field`, `type`, `interface`, `sort`, `width`) VALUES ("%s", "%s", "%s", "%s", "%s", "%s");';
            $insertSql = sprintf($insertSqlFormat, $collection, $field, $type, $interface, $sort ,$width);
            $this->execute($insertSql);
        }
    }
}
