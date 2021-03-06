<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'dividers2tabs' => true,
        'searchFields' => 'index_number,title,header,description',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden'
        ),
        'iconfile' => 'EXT:happy_feet/Resources/Public/Icons/TCA/Footnote.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'title,index_number'
    ),
    'columns'   => array(
        't3ver_label'      => array(
            'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'max'  => '30',
            )
        ),
        'sys_language_uid' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config'  => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items'               => array(
                    array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                )
            )
        ),
        'l18n_parent'      => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config'      => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'items'               => array(
                    array('', 0),
                ),
                'foreign_table'       => 'tx_happyfeet_domain_model_footnote',
                'foreign_table_where' => 'AND tx_happyfeet_domain_model_footnote.pid=###CURRENT_PID### AND tx_happyfeet_domain_model_footnote.sys_language_uid IN (-1,0)',
            )
        ),
        'l18n_diffsource'  => array(
            'config' => array(
                'type' => 'passthrough'
            )
        ),
        'hidden'           => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config'  => array(
                'type'    => 'check',
                'default' => '0'
            )
        ),
        'starttime'        => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'default'  => '0',
                'checkbox' => '0'
            )
        ),
        'endtime'          => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config'  => array(
                'type'     => 'input',
                'size'     => '8',
                'max'      => '20',
                'eval'     => 'date',
                'checkbox' => '0',
                'default'  => '0',
                'range'    => 'must be configured in ext_tables.php, behause the configuration-data is not cacheable!'
            )
        ),
        'index_number' => Array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote.index_number',
            'config'  => Array(
                'type' => 'none',
                'size' => 30,
            )
        ),
        'title' => array(
            'exclude' => 0,
            'label'   => 'LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote.title',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required,unique'
            )
        ),
        'header' => array(
            'exclude' => 0,
            'label'   => 'LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote.header',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            )
        ),
        'description' => array(
            'exclude' => 0,
            'label'   => 'LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote.description',
            'config'  => array(
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
                'eval' => 'required'
            ),
            'defaultExtras' => 'richtext[cut|copy|paste|class|bold|italic|underline|link|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_happyfeet/rte/]'
        )
    ),
    'types'     => array(
        '0' => array('showitem' => 'sys_language_uid, l18n_parent, l18n_diffsource, title, index_number, header, description, --div--;LLL:EXT:happy_feet/Resources/Private/Language/locallang_db.xml:tx_happyfeet_domain_model_footnote.tab.access, hidden,--palette--;;1')
    ),
    'palettes'  => array(
        '1' => array('showitem' => 'starttime, endtime')
    )
);
