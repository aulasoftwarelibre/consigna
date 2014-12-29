<?php

/* @Debug/Profiler/dump.html.twig */
class __TwigTemplate_ba6d3438c9a42d4c3d492f450e9d4065c295261a149e486cb0579ac529547dcd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $context["dumps_count"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "dumpsCount", array());
        // line 5
        echo "
    ";
        // line 6
        if ((isset($context["dumps_count"]) ? $context["dumps_count"] : $this->getContext($context, "dumps_count"))) {
            // line 7
            echo "        ";
            ob_start();
            // line 8
            echo "            <img alt=\"dump()\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAcCAYAAACOGPReAAACcUlEQVRIx+1UPUwUYRB97+Pc8ychMSaE4E+BrYWVgCd7e5dYQSxoiIFEjYWVdNiJiVjaSGFhowUkhsLEH2Jhcvsd54nYaQ0USoAYG7WBvWOfhd+R87zFC40N00z2zTdv30xmBti3/2ZBECy3+pZJgXw+f0rSiKQBkt2SOkluSFoh+SqKoplyufylJdIgCNIAJgGMkUzXcEkAEJM0DtqUNAVgwlq7Vc9hGtR1ACiSHCeZlvQGwFClUjkKYAVAexzHFyXNAkiTvEXSury/lTqFRZI9kr4DuGKtfV6L53K5tTAMu+reZwDMkuwC8F5SUFNcr3TSEf4g6dcTuvIP139ba8vGmD5JawB6Adz9o/xMJnMSwJhLvhGG4acm/T/UCBQKhc9xHA8DAMkxx/Ob1PO8UdfDD8Vi8WnCQAw1A+fn599KegbgoOd5Izukkgbc354kjZi1di4pJumx84M7pCRPO/DdXhaD5ILz3QDAXC4XATiQ8H48DMP7jWA2mx00xrxMUB3Rjcs6gE5JZ621H/ewwsdIfgOwHoZhV22klpz883spX1Kf80v1czrnwKtJidlsdnCXnl6r5zEAUK1WpwFskjwXBMFws8SkHvq+f4HkEIDN7e3tmR3SUqm06o4DADzyff9MK2X39/efMMbU5vpBqVRabVzTCUmLJNvb2tpKu5XrFPamUqkFksfd7t9pevry+XxHHMcvSPa4Hr+W9LBarVrP836mUqkjlUqlF8B1kpcBUNKiMeZSoVD4+q97eg/Azdo9lRSTNDXvsC0AUwBuN97TXS9/HMejAAbcpnQC2JC0THIuiqLppMvfsrnN27d/2y+hkCBqr75LOwAAAABJRU5ErkJggg==\" />
            <span class=\"sf-toolbar-status sf-toolbar-status-yellow\">";
            // line 9
            echo twig_escape_filter($this->env, (isset($context["dumps_count"]) ? $context["dumps_count"] : $this->getContext($context, "dumps_count")), "html", null, true);
            echo "</span>
        ";
            $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 11
            echo "
        ";
            // line 12
            ob_start();
            // line 13
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>dump()</b>
            </div>
            ";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "getDumps", array(0 => "html"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["dump"]) {
                // line 17
                echo "                <div class=\"sf-toolbar-info-piece\">
                    in
                    ";
                // line 19
                if ($this->getAttribute($context["dump"], "file", array())) {
                    // line 20
                    echo "                        ";
                    $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute($context["dump"], "file", array()), $this->getAttribute($context["dump"], "line", array()));
                    // line 21
                    echo "                        ";
                    if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                        // line 22
                        echo "                            <a href=\"";
                        echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                        echo "\" title=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "file", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                        echo "</a>
                        ";
                    } else {
                        // line 24
                        echo "                            <abbr title=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "file", array()), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                        echo "</abbr>
                        ";
                    }
                    // line 26
                    echo "                    ";
                } else {
                    // line 27
                    echo "                        ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                    echo "
                    ";
                }
                // line 29
                echo "                    line ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "line", array()), "html", null, true);
                echo ":
                    ";
                // line 30
                echo $this->getAttribute($context["dump"], "data", array());
                echo "
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dump'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            echo "            <img src=\"data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==\" onload=\"var h = this.parentNode.innerHTML, rx=/<script>(.*?)<\\/script>/g, s; while (s = rx.exec(h)) {eval(s[1]);};\" />
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 35
            echo "
        ";
            // line 36
            $this->env->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig")->display(array_merge($context, array("link" => true)));
            // line 37
            echo "    ";
        }
    }

    // line 40
    public function block_menu($context, array $blocks = array())
    {
        // line 41
        echo "    <span class=\"label\">
        <span class=\"icon\">";
        // line 43
        echo "";
        // line 44
        echo "<img alt=\"dump()\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAYAAAByDd+UAAADdUlEQVRIx71WPWwcVRD+ZneN3NzKiAgiJIrwZ9EQ2xchI+/uvb0g8SOouGtAKQAnSkHSJCZF6jSBUCQFkoNEEILGoaDCQVzeu1sLgeAI4cdyBE2qEMtE6LZA2bvbScGcWRt77+wYpntv5833vu/NzgywDVNK3VZK3d7OWRoQYC+ACgCfiEYB7JZPvzPzNQARgIvGmKt3Bej7/rjjOG8D2D8ggVqn05mJoujKlgCLxaJTKBTOENGRdT5LAH4D8KKsPwUwAWBPxoeZ+Vwcx8eazWZnfWxr/YbneSOu684T0VEB+4uZT3e73ce01k8w8+Ger9a6orV+mJn3AbjAzCkAIqKjruvOe543kstQmF0iorJc9TKA140x13s+5XL5fma+KYBrzgdBsM+yrI+J6PGexK1W67ks0zUMRcayLC/EcfxsFgwAkiRJNnufRqPxnW3bTzPzV7K1v1AonNlQ0jAMJ+TNAGCemac3egPHcdq5WVOr3bJt+yUAv+JvfY/4vj++EcPTIvGf7Xb7gDGmu1HA5eXlpG+q1mq3mPkAAAZAkun/AAZBMJZJ/VMLCwsrmwVbXFxsp2l6ME3Tg3mgxphvAHzSkzYMwycBwAEA27YrkiQJgA/6MajX6+8P+F/OAnhVYlcB/GjJwhe9I2PMH9gh01o3APTU8rNvOCrAV7DzdlXIjAIAhWGYABjKO5Gm6fP1en0+zycMw8MA3svzYebEwv9sJLe7AWA3M79jjJnZSYAwDL+UP+CG1vpBK1OUQUTj/wGpvSLn0mrSMHPUy1al1H07yC4AsEvINFYBu93unGzeQ0Sv9QtUKpWmS6XS9ACYhzIJM7cKGEXRT8z8hXw76XnerrwolmWdtyzrfB92TwF4RZaXjDG/rKmlaZqekNo34jjOh9VqddsZPDk5eS8zfwSAmDll5hP/Kt6NRuMHAGdF2hdWVlZmi8Wis1Uwz/NGhoeHP8v0xLPZWWcNi1ardVyaLgC84bru51NTUw8NCiYz0NdE5PcaRxzHM5uOGM1ms9PpdF7OgD4zNDS0pJQ6pZR6JG+qU0rN2rb9ba+EMfPldrtdWd9T84aod4nozYwPA1hi5p+JqCp7FwGMAXh00CGK+mTahDTmgcdEAG9prb+/q0E4CIIx27Yr0sZGiegBoXITwDUiiph5bpBBeLsVJJEus2W7A2Z3gfLvF5gPAAAAAElFTkSuQmCC\" />";
        // line 45
        echo "";
        // line 46
        echo "</span>
        <strong>dump()</strong>
        <span class=\"count\">
            <span>";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "dumpsCount", array()), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 54
    public function block_panel($context, array $blocks = array())
    {
        // line 55
        echo "    <h2>dump()</h2>

    <style>
        li.sf-dump {
            list-style-type: disc;
        }
        .sf-dump ol>li {
            padding: 0;
        }
        .sf-dump a {
            cursor: pointer;
        }
        .sf-dump-compact {
            display: none;
        }
    </style>

    <ul class=\"alt\">
        ";
        // line 73
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "getDumps", array(0 => "html"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["dump"]) {
            // line 74
            echo "        <li class=\"sf-dump sf-reset\">
            in
            ";
            // line 76
            if ($this->getAttribute($context["dump"], "line", array())) {
                // line 77
                echo "                ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute($context["dump"], "file", array()), $this->getAttribute($context["dump"], "line", array()));
                // line 78
                echo "                ";
                if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                    // line 79
                    echo "                    <a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "file", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                    echo "</a>
                ";
                } else {
                    // line 81
                    echo "                    <abbr title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "file", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                    echo "</abbr>
                ";
                }
                // line 83
                echo "            ";
            } else {
                // line 84
                echo "                ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "name", array()), "html", null, true);
                echo "
            ";
            }
            // line 86
            echo "            line ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["dump"], "line", array()), "html", null, true);
            echo ":
            <a onclick=\"Sfdump.toggle(this)\">▶</a>
            <span class=\"sf-dump-compact\">
            ";
            // line 89
            if ($this->getAttribute($context["dump"], "fileExcerpt", array())) {
                echo $this->getAttribute($context["dump"], "fileExcerpt", array());
            } else {
                echo $this->env->getExtension('code')->fileExcerpt($this->getAttribute($context["dump"], "file", array()), $this->getAttribute($context["dump"], "line", array()));
            }
            // line 90
            echo "            </span>

            ";
            // line 92
            echo $this->getAttribute($context["dump"], "data", array());
            echo "
        </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dump'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "@Debug/Profiler/dump.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  250 => 95,  241 => 92,  237 => 90,  231 => 89,  224 => 86,  218 => 84,  215 => 83,  207 => 81,  197 => 79,  194 => 78,  191 => 77,  189 => 76,  185 => 74,  181 => 73,  161 => 55,  158 => 54,  150 => 49,  145 => 46,  143 => 45,  141 => 44,  139 => 43,  136 => 41,  133 => 40,  128 => 37,  126 => 36,  123 => 35,  119 => 33,  110 => 30,  105 => 29,  99 => 27,  96 => 26,  88 => 24,  78 => 22,  75 => 21,  72 => 20,  70 => 19,  66 => 17,  62 => 16,  57 => 13,  55 => 12,  52 => 11,  47 => 9,  44 => 8,  41 => 7,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
