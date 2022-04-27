<?php

namespace App\Core;

class Form
{
    private $formCode = '';

    /**
     * HTML Form generator
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    public static function validate(array $form, array $champs)
    {
        foreach ($champs as $champ) {

            if (!isset($form[$champ]) || empty($form[$champ])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Add attributs at the html
     *
     * @param array $attributs
     * @return string
     */
    private function addAttributs(array $attributs): string
    {
        $str = '';

        $shorts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        foreach ($attributs as $attribut => $value) {

            if (in_array($attribut, $shorts) && $value == true) {
                $str .= " $attribut";
            } else {
                $str .= " $attribut=\"$value\"";
            }
        }

        return $str;
    }

    /**
     * Open the HTML for the form
     *
     * @param string $method
     * @param string $action
     * @param array $attributs
     * @return self
     */
    public function startForm(string $method = 'post', string $action = '#', array $attributs = []): self
    {
        $this->formCode .= "<form action='$action' method='$method'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) . '>' :  '>';

        return $this;
    }

    /**
     * Close tje HTML for the form
     *
     * @return self
     */
    public function endForm(): self
    {
        $this->formCode .= "</form>";

        return $this;
    }

    public function addLabelFor(string $for, $text, array $attributs = []): self
    {
        $this->formCode .= "<label for='$for'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$text</label>";

        return $this;
    }

    public function addInput(string $type, string $name, array $attributs = []): self
    {
        $this->formCode .= "<input type='$type' name='$name'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) . '>' : '>';

        return $this;
    }

    public function addtextArea(string $name, string $value, array $attributs = []): self
    {
        $this->formCode .= "<textarea name='$name'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$value</textarea>";

        return $this;
    }

    public function addSelect(string $name, array $options, array $attributs): self
    {
        $this->formCode .= "<select name='$name'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) . '>' : '>';

        foreach ($options as $value => $text) {
            $this->formCode .= "<option value=\"$value\">$text</option>";
        }

        $this->formCode .= "</select>";

        return $this;
    }

    public function addButton(string $text, array $attributs = []): self
    {
        $this->formCode .= '<button ';

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$text</button";
        return $this;
    }
}
