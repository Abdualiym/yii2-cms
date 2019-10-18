<?php

namespace abdualiym\cms\services;


use abdualiym\cms\entities\Text;
use abdualiym\cms\entities\TextMetaFields;
use abdualiym\cms\forms\TextForm;
use abdualiym\cms\forms\TextMetaFieldForm;
use abdualiym\cms\repositories\MetaFieldRepository;
use abdualiym\cms\repositories\TextMetaFieldRepository;
use abdualiym\cms\repositories\TextTranslationRepository;
use yii\helpers\VarDumper;

class TextMetaFieldManageService
{
    private $metaFields;
    private $transaction;

    public function __construct(
        TextMetaFieldRepository $metaFields,
        TransactionManager $transaction
    )
    {
        $this->metaFields = $metaFields;
        $this->transaction = $transaction;
    }

    /**
     * @param TextMetaFieldForm $form
     * @return Text
     */
    public function create(TextMetaFieldForm $form): TextMetaFields
    {
        $meta = TextMetaFields::create($form->text_id, $form->lang_id, $form->key, $form->value);

        $this->metaFields->save($meta);

        return $meta;
    }

    public function edit($id, TextMetaFieldForm $form)
    {
        $meta = $this->metaFields->get($id);

        $meta->edit(
            $form->text_id,
            $form->lang_id,
            $form->key,
            $form->value
        );

        $this->metaFields->save($meta);
    }

    public function remove($id)
    {
        $meta = $this->metaFields->get($id);
        $this->metaFields->remove($meta);
    }
}