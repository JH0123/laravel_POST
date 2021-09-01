<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AdminMenuComposer
{
    protected $menus;
    protected $topMenus;

    public function __construct()
    {
        $common = [
            [
                'title' => 'Dashboard',
                'url' => route('rhksfl.home', null, false),
            ],
        ];

        $setting = [
            [
                'nav_title' => '사이트 관리',
                'title' => '게시판 관리',
                'url' => route('rhksfl.board-infos.index', null, false),
            ],
            [
                'title' => '메뉴 관리',
                'url' => route('rhksfl.home', null, false),
            ],
        ];

        $this->topMenus = [
            $setting[0],
        ];

        $prefix = explode('/', request()->route()->getPrefix());

        if (count($prefix) > 1) {
            $prefix = $prefix[1];
            $this->menus = $$prefix;
        } else {
            $this->menus = $common;
        }
    }

    public function compose(View $view)
    {
        $view->with('adminTopMenus', $this->topMenus);
        $view->with('adminMenus', $this->menus);

        $nowPath = request()->server('REQUEST_URI');

        $nowMenu = 0;
        $nowPosition = '';
        $topMenuTitle = 'Dashboard';
        $nowMenuTitle = '';

        if ($nowPath && !empty($this->menus)) {
            foreach ($this->menus as $index => $menu) {
                if (!empty($menu['nav_title'])) {
                    $topMenuTitle = $menu['nav_title'];
                }

                if (!empty($menu['sub'])) {
                    foreach ($menu['sub'] as $subIndex => $subMenu) {
                        if (preg_match('/^(' . str_replace('/', '\/', $subMenu['url']) . ')(\/|\?|$)/', $nowPath)) {
                            $nowMenu = $index;
                            $nowPosition = $subIndex;
                            $nowMenuTitle = $subMenu['title'];
                            break;
                        }
                    }
                } else {
                    if (preg_match('/^(' . str_replace('/', '\/', $menu['url']) . ')(\/|\?|$)/', $nowPath)) {
                        $nowMenu = $index;
                        $nowMenuTitle = $menu['title'];
                        break;
                    }
                }
            }
        }

        $view->with('topMenuTitle', $topMenuTitle);
        $view->with('nowMenuTitle', $nowMenuTitle);
        $view->with('nowMenu', $nowMenu);
        $view->with('nowPosition', $nowPosition);
    }
}
