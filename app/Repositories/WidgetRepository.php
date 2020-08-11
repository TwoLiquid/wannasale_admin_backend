<?php

namespace App\Repositories;

use App\Models\Site;
use App\Models\Vendor;
use App\Models\Widget;
use App\Support\Models\WidgetDisplaySettings;
use Illuminate\Support\Collection;

class WidgetRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Widget::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param string $id
     * @return Widget|null
     */
    public function findById(string $id): ?Widget
    {
        /** @var Widget|null $widget */
        $widget = Widget::query()
            ->with('site')
            ->find($id);

        return $widget;
    }

    /**
     * @param string $id
     * @return Widget|null
     */
    public function findByKey(string $key): ?Widget
    {
        /** @var Widget $widget */
        $widget = Widget::query()->where('key', '=', $key)->first();

        return $widget;
    }

    /**
     * @param Site $site
     * @return Widget|null
     */
    public function getBySite(Site $site) : ?Widget
    {
        /** @var Widget $widget */
        return $site->widget;
    }

    /**
     * @param Site $site
     * @param bool $enabled
     * @param bool $on_item_page_only
     * @param bool $show_false
     * @return Widget
     */
    public function createForSite(
        Site $site,
        bool $enabled = true,
        bool $on_item_page_only = false,
        bool $show_false = true
    ): Widget {

        $displaySettings = new WidgetDisplaySettings(
            config('widget.defaults.display_settings.button_text'),
            config('widget.defaults.display_settings.button_color'),
            config('widget.defaults.display_settings.button_text_color'),
            config('widget.defaults.display_settings.button_width'),
            config('widget.defaults.display_settings.button_width_percent'),
            config('widget.defaults.display_settings.button_height'),
            config('widget.defaults.display_settings.button_font_size'),
            config('widget.defaults.display_settings.position'),
            config('widget.defaults.display_settings.bottom'),
            config('widget.defaults.display_settings.side'),
            config('widget.defaults.display_settings.title_text'),
            config('widget.defaults.display_settings.title_color'),
            config('widget.defaults.display_settings.text'),
            config('widget.defaults.display_settings.background_color'),
            config('widget.defaults.display_settings.checkbox_text'),
            config('widget.defaults.display_settings.checkbox_text_color'),
            config('widget.defaults.display_settings.window_button_text'),
            config('widget.defaults.display_settings.window_button_color'),
            config('widget.defaults.display_settings.window_button_text_color'),
            config('widget.defaults.display_settings.message_text'),
            config('widget.defaults.display_settings.message_text_color'),
            config('widget.defaults.display_settings.message_background_color'),
            config('widget.defaults.display_settings.show_phone')
        );

        /** @var Widget $widget */
        $widget = $site->widget()
            ->create([
                'enabled' => $enabled,
                'on_item_page_only' => $on_item_page_only,
                'show_false' => $show_false,
                'key' => $this->generateUniqueKey(),
                'display_settings' => $displaySettings
            ]);

        return $widget;
    }

    /**
     * @param Widget $widget
     * @param bool|null $enabled
     * @param bool|null $on_item_page_only
     * @param bool|null $show_phone
     * @return Widget
     */
    public function updateSettings(
        Widget $widget,
        ?bool $enabled = true,
        ?bool $on_item_page_only = false
    ) : Widget
    {
        /** @var Widget $widget */
        $widget->update([
            'enabled' => $enabled === null ? false : true,
            'on_item_page_only' => $on_item_page_only === null ? false : true
        ]);

        return $widget;
    }

    /**
     * @param Widget $widget
     * @param WidgetDisplaySettings $displaySettings
     * @return Widget
     */
    public function updateDisplaySettings(
        Widget $widget,
        WidgetDisplaySettings $displaySettings
    ) : Widget
    {
        /** @var Widget $widget */
        $widget->update([
            'display_settings' => $displaySettings
        ]);

        return $widget;
    }

    /**
     * @return string
     */
    private function generateUniqueKey() : string
    {
        do {
            $key = str_random('10');
            $widgetWithKeyExist = Widget::query()
                ->where('key', $key)
                ->exists();
        } while ($widgetWithKeyExist === true);

        return $key;
    }
}