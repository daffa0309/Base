<?php
if (!function_exists('action_button')) {

/**
 * Generate action button table
 *
 * @param string $route
 * @param string $title
 * @param string $icon
 * @param array $classes
 *
 * @return string
 */
    function action_button(string $route, $title, $classes = [], $datas = [])
    {
        $cl = '';
        foreach ($classes as $class) {
            $cl .= $class;
            $cl .= ' ';
        }

        $dt = '';
        foreach ($datas as $data) {
            $dt .= $data;
            $dt .= ' ';
        }


        return "<a href='javascript:void(0);' style='margin:3px' data-url='{$route}' class='btn btn-{$cl} btn-{$dt} btn-xs'>{$title}</a>";
    }

    function href_button(string $route, $title, $classes = [])
    {
        $cl = '';
        foreach ($classes as $class) {
            $cl .= $class;
            $cl .= ' ';
        }

        return "<a href='{$route}' style='margin:3px' class='btn btn-{$cl}  btn-xs'>{$title}</a>";
    }
}

if (!function_exists('form_button')) {

    /**
     * Generate Form Button
     *
     * @param string $url
     * @param string $method
     * @param string $title
     * @param string $icon
     * @param array $classes
     *
     * @return string
     */
    function form_button(string $url, string $method = 'DELETE', string $title, $classes = [])
    {
        $cl = '';
        foreach ($classes as $class) {
            $cl .= $class;
            $cl .= ' ';
        }

        $html = "<form action='{$url}' method='POST' style='display: inline-block;'>";
        $html .= csrf_field();
        $html .= method_field($method);
        $html .= '<button type="submit" class=" btn btn-confirm btn-xs  btn-' . $cl . ' ">' . $title;
        $html .= '</button>';
        $html .= '</form>';

        return $html;
    }
}

if (!function_exists('action_form')) {

    /**
     * Generate action button table
     *
     * @param string $route
     * @param string $title
     * @param string $icon
     * @param array $classes
     *
     * @return string
     */
    function action_form(string $url, string $method = 'DELETE', $classes = [], string $title )
    {
        $cl = '';
        foreach ($classes as $class) {
            $cl .= $class;
            $cl .= ' ';
        }

        $html = "<form action='{$url}' method='POST' style='display: inline-block;'>";
        $html .= csrf_field();
        $html .= method_field($method);
        $html .= "<a href='javascript:void(0)' class='btn btn-confirm btn-{$cl} btn-xs'>{$title} </a>";
        $html .= '</form>';

        return $html;
    }
}

if (!function_exists('actmenu')) {
    # code...
    function actmenu(string $urlpath)
    {
        if ($urlpath == '#') return 'kosong';

        $url        = strtolower(urldecode(request()->path()));
// var_dump([$urlpath, 'asdasd', $url]);
        if (strtolower($urlpath) == $url) {
            return 'active';
        } else {
            return ' ';
        }
    }
}
if (!function_exists('actmenuend')) {
    # code...
    function actmenuend(string $urlpath)
    {
        $url        = strtolower(urldecode(request()->path()));

        if (strtolower($urlpath) == $url) {
            return 'active eeee';
        } else {
            return ' ';
        }
    }
}

if (!function_exists('actmenuone')) {
    # code...
    function actmenuone($exist)
    {
        if ($exist != null) {
            return 'down';
        } else {
            return 'right';
        }
    }
}

if (!function_exists('actmenutwo')) {
    # code...
    function actmenutwo(string $urlpath)
    {
        $url        = strtolower(urldecode(request()->path()));

        if (strtolower($urlpath) == $url) {
            return 'block;';
        } else {
            return 'none;';
        }
    }
}


if (!function_exists('acthelper')) {
    # code...
    function acthelper($menu)
    {
        $exist = null;
        if ($menu->childs->count() > 0) {
            foreach ($menu->childs as $menu1) {
                if (actmenutwo($menu1->url) != 'none;') {
                    $exist = [$menu1->id, 0];
                    break;
                }
                foreach ($menu1->childs as $menu2) {
                    if (actmenuend($menu2->url) != ' ') {
                        $exist = [$menu1->id, $menu2->id];
                        break;
                    }
                }
            }
        } else {
            if (actmenuend($menu->url) != ' ') {
                $exist = [$menu->id, 0];
            }
        }

        return $exist;
    }
}
