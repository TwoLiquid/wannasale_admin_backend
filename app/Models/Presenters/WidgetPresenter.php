<?php

namespace App\Models\Presenters;

use App\Support\Models\WidgetDisplaySettings;

trait WidgetPresenter
{
    /**
     * @return WidgetDisplaySettings
     */
    public function getDisplaySettingsAttribute()
    {
        $displaySettings = json_decode($this->attributes['display_settings']);

        if ($displaySettings === null) {
            return null;
        }

        return new WidgetDisplaySettings(
            $displaySettings->button_text,
            $displaySettings->button_color,
            $displaySettings->button_text_color,
            isset($displaySettings->button_width) ? $displaySettings->button_width : config('widget.defaults.display_settings.button_width'),
            isset($displaySettings->button_width_percent) ? $displaySettings->button_width_percent : config('widget.defaults.display_settings.button_width_percent'),
            isset($displaySettings->button_height) ? $displaySettings->button_height : config('widget.defaults.display_settings.button_height'),
            isset($displaySettings->button_font_size) ? $displaySettings->button_font_size : config('widget.defaults.display_settings.button_font_size'),
            $displaySettings->position,
            $displaySettings->side,
            $displaySettings->bottom,
            $displaySettings->title_text,
            $displaySettings->title_color,
            $displaySettings->text,
            $displaySettings->background_color,
            $displaySettings->checkbox_text,
            $displaySettings->checkbox_text_color,
            $displaySettings->window_button_text,
            $displaySettings->window_button_color,
            $displaySettings->window_button_text_color,
            $displaySettings->message_text,
            $displaySettings->message_text_color,
            $displaySettings->message_background_color,
            $displaySettings->show_phone
        );
    }

    /**
     * @param WidgetDisplaySettings $displaySettings
     * @return string
     */
    public function setDisplaySettingsAttribute(WidgetDisplaySettings $displaySettings)
    {
        $this->attributes['display_settings'] = json_encode($displaySettings->toArray());
    }
}
