<?php

namespace app\widgets;

use yii\widgets\ActiveField as BaseActiveField;
use yii\helpers\Html;


class CustomActiveField extends BaseActiveField {

    public function nestedSetSelector($data, $options = []) {
        $options = array_merge($this->inputOptions, $options);
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        
        $name = isset($options['name']) ? $options['name'] : Html::getInputName($this->model, $this->attribute);
        $value = isset($options['value']) ? $options['value'] : Html::getAttributeValue($this->model, $this->attribute);
        
        $html = "";
        if (!empty($data)) foreach ($data as $k=>$i) {
            $indent = "";
            for ($n = 1; $n <= $i->depth; $n++) {
                $indent = $indent . "&nbsp;&nbsp;&nbsp;";
            }
            $checked = false;
            if ($i->id == $value) {
                $checked = true;
            }
            $html = $html.
                Html::tag("div",
                    Html::label(
                        $indent.Html::radio($name, $checked, ["value"=>$i->id])." {$i->name}",
                        null,
                        ["class"=>"form-check-label"]
                    ),
                ["class"=>"modal-radio"]);
        }
        
        $this->parts['{input}'] = $html;
        return $this;
    }

}
