<?php

/* WebProfilerExtraBundle:Collector:twig.html.twig */
class __TwigTemplate_44ea2f780b07ff2e3d5c2cceb387bf051f04d753d4a2c7ceefb2bcc62555bb96 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
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
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "displayInWdt", array())) {
            // line 5
            echo "        ";
            $context["icon"] = ('' === $tmp = "            <img height=\"28\" alt=\"Twig\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAMAAABWBG9SAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoyMjY5ODc2QTRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoyMjY5ODc2QjRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjVCRTZBQjUxNEVDRTExRTI5RDM1QjZBOTBCNThGRTZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjVCRTZBQjUyNEVDRTExRTI5RDM1QjZBOTBCNThGRTZCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+YSuGKQAAAWJQTFRFOz09PD09PT4+hISDUlJSkpKT/v7+PkBAQUFBUVBQ8fDwPD4+hYSDv76+oKGhNjc34+Litra1W1pasbCweXl5vby8U1NTt7a2e3t709PTREVFg4KCtLS0OTs74ODgODo6goGBVVVV8PDwv7+/8fHxkZKSd3Z2b25ucHFxMzU1mZqaT09P9vb2hIWEnZyceXh3zs7OlZaXWVpa19fX09PUnqCg29rbp6enT1BPkJGRn6CggoGAwsHB+vr6vLy8wcHBj4+PTU1NoaKieXh4fX18hoSE1dXWTk5NUVFQTk9OUE9PT05O6enpl5iYVVZWe3p5zMzMz87OS0xLtbW1iomJ+/v73dzdMjQ0gX9/0dDQOjw8ODg4UE9Oj42NUlNT6urql5eY8fHwWFlYiIeGUlNShIODrq2tMTIys7KynJ2eS0pJf319srGx3t7ffHx71NTUenp62traT1BQPz8/P0BA////xP9xOwAAAHZ0Uk5T////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AAFiqUcAAADxSURBVHjaYijFAhgoFNRN8ixCARZGegwp5m6S+UhA0kRdgkE7EF2zlggDi2ipsAIzHCgIlyYABXlL/WWZ4EDWpZS1ACQYIc8IB/LWUMGQIA8vd29OMHCMLVUtYFDMKA1VUeLyiU/kAgElnVLLAgYx0VJjcRmbUltxQRCQiQSpZFEuVYvijmGT42AvAQKGPKiZ0gzcQmwCUEEesKAyFkGgmakYgn45pckYgorBpa6YZvKWZqdrZrHJRfODQLg+WNCuNCDTKq1UxYkPBEztSw1FGIoM0IPOt4AhTji3EBmYhTlLMGhIFaMBKQcGGsQ7QIABAMedrCZHnT6FAAAAAElFTkSuQmCC\"/>
            <span class=\"sf-toolbar-info-piece-additional-detail\">Twig</span>
        ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 9
            echo "        ";
            ob_start();
            // line 10
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Template";
            // line 11
            echo (((1 == twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "templates", array())))) ? (":") : ("s"));
            echo "</b>
                <span>
                    ";
            // line 13
            if ((1 == twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "templates", array())))) {
                // line 14
                echo "                        ";
                $context["template"] = twig_first($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "templates", array()));
                // line 15
                echo "                        ";
                if ($this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "path", array())) {
                    // line 16
                    echo "                            <a class=\"sf-toolbar-info-method\" href=\"";
                    echo $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "path", array()), 1);
                    echo "\">
                                ";
                    // line 17
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "name", array()), "html", null, true);
                    echo "
                            </a>
                        ";
                } else {
                    // line 20
                    echo "                            ";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "name", array()), "html", null, true);
                    echo "
                        ";
                }
                // line 22
                echo "                    ";
            } else {
                // line 23
                echo "                        ";
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "templates", array())), "html", null, true);
                echo "
                    ";
            }
            // line 25
            echo "                </span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Globals</b>
                <span>";
            // line 29
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "globals", array())), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Extensions</b>
                <span>";
            // line 33
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "extensions", array())), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>avail. Tests</b>
                <span>";
            // line 37
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "tests", array())), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>avail. Filters</b>
                <span>";
            // line 41
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "filters", array())), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>avail. Functions</b>
                <span>";
            // line 45
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "functions", array())), "html", null, true);
            echo "</span>
            </div>
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 48
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
            // line 49
            echo "    ";
        }
    }

    // line 52
    public function block_menu($context, array $blocks = array())
    {
        // line 53
        echo "    <span class=\"label\">
        <span class=\"icon\">
            <img width=30 src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAqCAYAAAAqAaJlAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MzBCQTQ1NUY0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MzBCQTQ1NjA0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozMEJBNDU1RDRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozMEJBNDU1RTRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuwAElIAAAJ4SURBVHja7Ji9bhNBEMdnd++iiyIsW5ZfILYTKhJ4AzoKmkjUqaggXSRAPACCiCBBkCmh4BVQKCjyBJAmCorjlJTY4Dvuc2/ZOeei+CPGvsTHnnRjySet15qf5v47szOkWCrdLZfLd8IwdEBRs2zbuL++/lmToLdr1cWHQcAh4FwpSEIIMErB8VyoVCquJiMaIqh8QLFwTSlQLrm6fyxAPs55qOEPXIIWFhZg6+WreVVgGWOlw4ODH292XoMlegrVzm9YqteU0W2zdWKHQvStaeP+cNQ8NvB1pGVCwo0L2FhYlSJ9ISxGFEGfPn4ivu5/gzldmzmI5wdwa/UmPHvxPHqV9epiR2p28sh2frWh0+1KWD0FWD/yN3VkY6Myx2Gew+fMT/8EfihkyHLYVLNBbIE8oSj8NAz9oL+pYeP8emNlBQzDAD2F1OVL0KXl5eSRfbCxQTKj2eZxKzuw9VpVZKbcPtrclOV2f6jcor6uS33tNBp9kb+3tia6pimvdzTBAcNyuwpb29skkWYtywLTsWEu6C+3fhCAaZmj2g+wHCdRxfMCP/KX+IARKtsKMlwGqVynI66OuEYTlmf0g/7yCpbD5rAqwarWe+UyyGFz2P8Fi7euzPVgIHD+BKdf/eujt4toXjW0fwLr+UkIe/j9yACCc1I4/Tp/HbvgloYfQob3T2A9Pwlg46LwtvFuKq+fdnevrA1qtk6KU8ngXyNP2fY4Az3bpbSe6shzEH6mB+yykblKY4zN47CODMJiO+J6Lnz88N5WJqdSBu32T/A5P8uvWtxTOa4HX/b21EqsMog6Y2fZBWGdKMcR8ltPYWic0ArI+VeAAQAHsPLrOHrwLwAAAABJRU5ErkJggg==\" />
        </span>
        <strong>Twig</strong>
        <span class=\"count\">
            <span>";
        // line 59
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "extensions", array())), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 64
    public function block_panel($context, array $blocks = array())
    {
        // line 65
        echo "    <h2>Twig Templates</h2>
    <table>
        <tr>
            <th>Template</th>
            <th>Parameters</th>
        </tr>
        ";
        // line 71
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "templates", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
            // line 72
            echo "        <tr>
            <th>
                ";
            // line 74
            if ($this->getAttribute($context["template"], "path", array())) {
                // line 75
                echo "                    <a href=\"";
                echo $this->env->getExtension('code')->getFileLink($this->getAttribute($context["template"], "path", array()), 1);
                echo "\">
                        ";
                // line 76
                echo twig_escape_filter($this->env, $this->getAttribute($context["template"], "name", array()), "html", null, true);
                echo "
                    </a>
                ";
            } else {
                // line 79
                echo "                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["template"], "name", array()), "html", null, true);
                echo "
                ";
            }
            // line 81
            echo "            </th>
            <td>
                ";
            // line 83
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["template"], "parameters", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["parameter"] => $context["metadata"]) {
                // line 84
                echo "                    ";
                if (($this->getAttribute($context["metadata"], "type", array()) == "boolean")) {
                    // line 85
                    echo "                        ";
                    $context["value"] = (($this->getAttribute($context["metadata"], "value", array())) ? ("true") : ("false"));
                    // line 86
                    echo "                    ";
                } elseif (($this->getAttribute($context["metadata"], "type", array()) == "string")) {
                    // line 87
                    echo "                        ";
                    $context["maxStrLength"] = 40;
                    // line 88
                    echo "                        ";
                    $context["value"] = $this->getAttribute($context["metadata"], "value", array());
                    // line 89
                    echo "                        ";
                    if ((twig_length_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) > (isset($context["maxStrLength"]) ? $context["maxStrLength"] : $this->getContext($context, "maxStrLength")))) {
                        // line 90
                        echo "                            ";
                        $context["value"] = (twig_slice($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), 0, (isset($context["maxStrLength"]) ? $context["maxStrLength"] : $this->getContext($context, "maxStrLength"))) . "…");
                        // line 91
                        echo "                        ";
                    }
                    // line 92
                    echo "                        ";
                    $context["value"] = (("\"" . (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) . "\"");
                    // line 93
                    echo "                    ";
                } else {
                    // line 94
                    echo "                        ";
                    $context["value"] = $this->getAttribute($context["metadata"], "value", array());
                    // line 95
                    echo "                    ";
                }
                // line 96
                echo "                    <code>
                        ";
                // line 97
                echo twig_escape_filter($this->env, $context["parameter"], "html", null, true);
                echo ": <em style=\"color: #aaa\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["metadata"], "type", array()), "html", null, true);
                echo "</em>
                        <span style=\"color: #009E00\">";
                // line 98
                echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
                echo "</span>
                    </code>
                    ";
                // line 100
                if ((!$this->getAttribute($context["loop"], "last", array()))) {
                    echo "<br />";
                }
                // line 101
                echo "                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['parameter'], $context['metadata'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 102
            echo "            </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "    </table>
    <br />
    <h2>Twig Globals</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
        ";
        // line 113
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "globals", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["global"]) {
            // line 114
            echo "            <tr>
                <th>";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["global"], "name", array()), "html", null, true);
            echo "</th>
                <td><code>";
            // line 116
            echo twig_escape_filter($this->env, $this->getAttribute($context["global"], "value", array()), "html", null, true);
            echo "</code></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['global'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        echo "    </table>
    <h2>Twig Extensions</h2>
    <table>
        <tr>
            <th>Extension</th>
            <th>Class</th>
        </tr>
        ";
        // line 126
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "extensions", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 127
            echo "            <tr>
                <th>";
            // line 128
            echo twig_escape_filter($this->env, $this->getAttribute($context["extension"], "name", array()), "html", null, true);
            echo "</th>
                <td><code>";
            // line 129
            echo twig_escape_filter($this->env, $this->getAttribute($context["extension"], "class", array()), "html", null, true);
            echo "</code></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "    </table>

    <h2>Twig Tests available</h2>
    <table>
        <tr>
            <th>Test</th>
            <th>Call</th>
            <th>Extension</th>
        </tr>
        ";
        // line 141
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "tests", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["test"]) {
            // line 142
            echo "            <tr>
                <th>";
            // line 143
            echo twig_escape_filter($this->env, $this->getAttribute($context["test"], "name", array()), "html", null, true);
            echo "</th>
                <td><code>";
            // line 144
            echo twig_escape_filter($this->env, $this->getAttribute($context["test"], "call", array()), "html", null, true);
            echo "</code></td>
                <td>";
            // line 145
            echo twig_escape_filter($this->env, $this->getAttribute($context["test"], "extension", array()), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['test'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        echo "    </table>

    <h2>Twig Filters available</h2>
    <table>
        <tr>
            <th>Filter</th>
            <th>Call</th>
            <th>Extension</th>
        </tr>
        ";
        // line 157
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "filters", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["filter"]) {
            // line 158
            echo "            <tr>
                <th>";
            // line 159
            echo twig_escape_filter($this->env, $this->getAttribute($context["filter"], "name", array()), "html", null, true);
            echo "</th>
                <td><code>";
            // line 160
            echo twig_escape_filter($this->env, $this->getAttribute($context["filter"], "call", array()), "html", null, true);
            echo "</code></td>
                <td>";
            // line 161
            echo twig_escape_filter($this->env, $this->getAttribute($context["filter"], "extension", array()), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 164
        echo "    </table>

    <h2>Twig Functions available</h2>
    <table>
        <tr>
            <th>Function</th>
            <th>Call</th>
            <th>Extension</th>
        </tr>
        ";
        // line 173
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "functions", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["function"]) {
            // line 174
            echo "            <tr>
                <th>";
            // line 175
            echo twig_escape_filter($this->env, $this->getAttribute($context["function"], "name", array()), "html", null, true);
            echo "</th>
                <td><code>";
            // line 176
            echo twig_escape_filter($this->env, $this->getAttribute($context["function"], "call", array()), "html", null, true);
            echo "</code></td>
                <td>";
            // line 177
            echo twig_escape_filter($this->env, $this->getAttribute($context["function"], "extension", array()), "html", null, true);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['function'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 180
        echo "    </table>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerExtraBundle:Collector:twig.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  452 => 180,  443 => 177,  439 => 176,  435 => 175,  432 => 174,  428 => 173,  417 => 164,  408 => 161,  404 => 160,  400 => 159,  397 => 158,  393 => 157,  382 => 148,  373 => 145,  369 => 144,  365 => 143,  362 => 142,  358 => 141,  347 => 132,  338 => 129,  334 => 128,  331 => 127,  327 => 126,  318 => 119,  309 => 116,  305 => 115,  302 => 114,  298 => 113,  288 => 105,  280 => 102,  266 => 101,  262 => 100,  257 => 98,  251 => 97,  248 => 96,  245 => 95,  242 => 94,  239 => 93,  236 => 92,  233 => 91,  230 => 90,  227 => 89,  224 => 88,  221 => 87,  218 => 86,  215 => 85,  212 => 84,  195 => 83,  191 => 81,  185 => 79,  179 => 76,  174 => 75,  172 => 74,  168 => 72,  164 => 71,  156 => 65,  153 => 64,  145 => 59,  137 => 53,  134 => 52,  129 => 49,  126 => 48,  120 => 45,  113 => 41,  106 => 37,  99 => 33,  92 => 29,  86 => 25,  80 => 23,  77 => 22,  71 => 20,  65 => 17,  60 => 16,  57 => 15,  54 => 14,  52 => 13,  47 => 11,  44 => 10,  41 => 9,  36 => 5,  33 => 4,  30 => 3,);
    }
}
