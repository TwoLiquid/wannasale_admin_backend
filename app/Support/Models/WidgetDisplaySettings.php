<?php

namespace App\Support\Models;

class WidgetDisplaySettings {
    private $button_text;
    private $button_color;
    private $button_text_color;
    private $button_width;
    private $button_width_percent;
    private $button_height;
    private $button_font_size;
    private $position;
    private $side;
    private $bottom;
    private $title_text;
    private $title_color;
    private $text;
    private $background_color;
    private $checkbox_text;
    private $checkbox_text_color;
    private $window_button_text;
    private $window_button_color;
    private $window_button_text_color;
    private $message_text;
    private $message_text_color;
    private $message_background_color;
    private $show_phone;

    /**
     * WidgetDisplaySettings constructor.
     * @param null|string $button_text
     * @param null|string $button_color
     * @param null|string $button_text_color
     * @param int|null $button_width
     * @param bool|null $button_width_percent
     * @param int|null $button_height
     * @param int|null $button_font_size
     * @param int|null $position
     * @param int|null $side
     * @param int|null $bottom
     * @param null|string $title_text
     * @param null|string $title_color
     * @param null|string $text
     * @param null|string $background_color
     * @param null|string $checkbox_text
     * @param null|string $checkbox_text_color
     * @param null|string $window_button_text
     * @param null|string $window_button_color
     * @param null|string $window_button_text_color
     * @param null|string $message_text
     * @param null|string $message_text_color
     * @param null|string $message_background_color
     * @param bool|null $show_phone
     */
    public function __construct(
        ?string $button_text,
        ?string $button_color,
        ?string $button_text_color,
        ?int $button_width,
        ?bool $button_width_percent,
        ?int $button_height,
        ?int $button_font_size,
        ?int $position,
        ?int $side,
        ?int $bottom,
        ?string $title_text,
        ?string $title_color,
        ?string $text,
        ?string $background_color,
        ?string $checkbox_text,
        ?string $checkbox_text_color,
        ?string $window_button_text,
        ?string $window_button_color,
        ?string $window_button_text_color,
        ?string $message_text,
        ?string $message_text_color,
        ?string $message_background_color,
        ?bool $show_phone
    )
    {
        $this->button_text = $button_text;
        $this->button_color = $button_color;
        $this->button_text_color = $button_text_color;
        $this->button_width = $button_width;
        $this->button_width_percent = $button_width_percent;
        $this->button_height = $button_height;
        $this->button_font_size = $button_font_size;
        $this->position = $position;
        $this->side = $side;
        $this->bottom = $bottom;
        $this->title_text = $title_text;
        $this->title_color = $title_color;
        $this->text = $text;
        $this->background_color = $background_color;
        $this->checkbox_text = $checkbox_text;
        $this->checkbox_text_color = $checkbox_text_color;
        $this->window_button_text = $window_button_text;
        $this->window_button_color = $window_button_color;
        $this->window_button_text_color = $window_button_text_color;
        $this->message_text = $message_text;
        $this->message_text_color = $message_text_color;
        $this->message_background_color = $message_background_color;
        $this->show_phone = $show_phone;

        return $this;
    }

    public function toArray() : array
    {
        return [
            'button_text'               => $this->button_text,
            'button_color'              => $this->button_color,
            'button_text_color'         => $this->button_text_color,
            'button_width'              => $this->button_width,
            'button_width_percent'      => $this->button_width_percent,
            'button_height'             => $this->button_height,
            'button_font_size'          => $this->button_font_size,
            'position'                  => $this->position,
            'side'                      => $this->side,
            'bottom'                    => $this->bottom,
            'title_text'                => $this->title_text,
            'title_color'               => $this->title_color,
            'text'                      => $this->text,
            'background_color'          => $this->background_color,
            'checkbox_text'             => $this->checkbox_text,
            'checkbox_text_color'       => $this->checkbox_text_color,
            'window_button_text'        => $this->window_button_text,
            'window_button_color'       => $this->window_button_color,
            'window_button_text_color'  => $this->window_button_text_color,
            'message_text'              => $this->message_text,
            'message_text_color'        => $this->message_text_color,
            'message_background_color'  => $this->message_background_color,
            'show_phone'                => $this->show_phone
        ];
    }

    /**
     * @return null|string
     */
    public function getButtonText() : ?string
    {
        return $this->button_text;
    }

    /**
     * @param string $buttonText
     * @return WidgetDisplaySettings
     */
    public function setButtonText(string $buttonText) : WidgetDisplaySettings
    {
        $this->button_text = $buttonText;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getButtonColor() : ?string
    {
        return $this->button_color;
    }

    /**
     * @param string $buttonColor
     * @return WidgetDisplaySettings
     */
    public function setButtonColor(string $buttonColor) : WidgetDisplaySettings
    {
        $this->button_color = $buttonColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getButtonTextColor() : ?string
    {
        return $this->button_text_color;
    }

    /**
     * @param string $buttonTextColor
     * @return WidgetDisplaySettings
     */
    public function setButtonTextColor(string $buttonTextColor) : WidgetDisplaySettings
    {
        $this->button_text_color = $buttonTextColor;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getButtonWidth() : ?int
    {
        return $this->button_width;
    }

    /**
     * @param int $buttonWidth
     * @return WidgetDisplaySettings
     */
    public function setButtonWidth(int $buttonWidth) : WidgetDisplaySettings
    {
        $this->button_width = $buttonWidth;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getButtonWidthPercent() : ?bool
    {
        return $this->button_width_percent;
    }

    /**
     * @param bool $buttonWidthPercent
     * @return WidgetDisplaySettings
     */
    public function setButtonWidthPercent(bool $buttonWidthPercent) : WidgetDisplaySettings
    {
        $this->button_width_percent = $buttonWidthPercent;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getButtonHeight() : ?int
    {
        return $this->button_height;
    }

    /**
     * @param int $buttonHeight
     * @return WidgetDisplaySettings
     */
    public function setButtonHeight(int $buttonHeight) : WidgetDisplaySettings
    {
        $this->button_height = $buttonHeight;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getButtonFontSize() : ?int
    {
        return $this->button_font_size;
    }

    /**
     * @param int $buttonFontSize
     * @return WidgetDisplaySettings
     */
    public function setButtonFontSize(int $buttonFontSize) : WidgetDisplaySettings
    {
        $this->button_font_size = $buttonFontSize;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition() : ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return WidgetDisplaySettings
     */
    public function setPosition(int $position) : WidgetDisplaySettings
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSide() : ?int
    {
        return $this->side;
    }

    /**
     * @param int $side
     * @return WidgetDisplaySettings
     */
    public function setSide(int $side) : WidgetDisplaySettings
    {
        $this->side = $side;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBottom() : ?int
    {
        return $this->bottom;
    }

    /**
     * @param int $bottom
     * @return WidgetDisplaySettings
     */
    public function setBottom(int $bottom) : WidgetDisplaySettings
    {
        $this->bottom = $bottom;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitleText() : ?string
    {
        return $this->title_text;
    }

    /**
     * @param string $title_text
     * @return WidgetDisplaySettings
     */
    public function setTitleText(string $title_text) : WidgetDisplaySettings
    {
        $this->title_text = $title_text;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitleColor() : ?string
    {
        return $this->title_color;
    }

    /**
     * @param string $title_color
     * @return WidgetDisplaySettings
     */
    public function setTitleColor(string $title_color) : WidgetDisplaySettings
    {
        $this->title_color = $title_color;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     * @return WidgetDisplaySettings
     */
    public function setText(?string $text) : WidgetDisplaySettings
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBackgroundColor() : ?string
    {
        return $this->background_color;
    }

    /**
     * @param string $backgroundColor
     * @return WidgetDisplaySettings
     */
    public function setBackgroundColor(string $backgroundColor) : WidgetDisplaySettings
    {
        $this->background_color = $backgroundColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCheckboxText() : ?string
    {
        return $this->checkbox_text;
    }

    /**
     * @param string $checkboxText
     * @return WidgetDisplaySettings
     */
    public function setCheckboxText(string $checkboxText) : WidgetDisplaySettings
    {
        $this->checkbox_text = $checkboxText;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCheckboxTextColor() : ?string
    {
        return $this->checkbox_text_color;
    }

    /**
     * @param string $checkboxTextColor
     * @return WidgetDisplaySettings
     */
    public function setCheckboxTextColor(string $checkboxTextColor) : WidgetDisplaySettings
    {
        $this->checkbox_text_color = $checkboxTextColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWindowButtonText() : ?string
    {
        return $this->window_button_text;
    }

    /**
     * @param string $windowButtonText
     * @return WidgetDisplaySettings
     */
    public function setWindowButtonText(string $windowButtonText) : WidgetDisplaySettings
    {
        $this->window_button_text = $windowButtonText;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWindowButtonColor() : ?string
    {
        return $this->window_button_color;
    }

    /**
     * @param string $windowButtonColor
     * @return WidgetDisplaySettings
     */
    public function setWindowButtonColor(string $windowButtonColor) : WidgetDisplaySettings
    {
        $this->window_button_color = $windowButtonColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getWindowButtonTextColor() : ?string
    {
        return $this->window_button_text_color;
    }

    /**
     * @param string $windowButtonTextColor
     * @return WidgetDisplaySettings
     */
    public function setWindowButtonTextColor(string $windowButtonTextColor) : WidgetDisplaySettings
    {
        $this->window_button_text_color = $windowButtonTextColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessageText() : ?string
    {
        return $this->message_text;
    }

    /**
     * @param string $messageText
     * @return WidgetDisplaySettings
     */
    public function setMessageText(string $messageText) : WidgetDisplaySettings
    {
        $this->message_text = $messageText;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessageTextColor() : ?string
    {
        return $this->message_text_color;
    }

    /**
     * @param string $messageColor
     * @return WidgetDisplaySettings
     */
    public function setMessageTextColor(string $messageColor) : WidgetDisplaySettings
    {
        $this->message_text_color = $messageColor;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessageBackgroundColor() : ?string
    {
        return $this->message_background_color;
    }

    /**
     * @param string $messageBackgroundColor
     * @return WidgetDisplaySettings
     */
    public function setMessageBackgroundColor(string $messageBackgroundColor) : WidgetDisplaySettings
    {
        $this->message_background_color = $messageBackgroundColor;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowPhone() : ?bool
    {
        return $this->show_phone;
    }

    /**
     * @param string $showPhone
     * @return WidgetDisplaySettings
     */
    public function setShowPhone(?bool $showPhone) : WidgetDisplaySettings
    {
        $this->show_phone = $showPhone;

        return $this;
    }
}