<?php

/* WebProfilerExtraBundle:Collector:routing.html.twig */
class __TwigTemplate_d1895aa6beb155447364be394c293b7fd92ce6cd1fabec58beede2f45f46c30c extends Twig_Template
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
            $context["icon"] = ('' === $tmp = "            <img height=\"28\" alt=\"Routing\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAcCAMAAAC5xgRsAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpGMkUzNEM1QjRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpGMkUzNEM1QzRFRDIxMUUyOUQzNUI2QTkwQjU4RkU2QiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjIyNjk4Nzc0NEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkYyRTM0QzVBNEVEMjExRTI5RDM1QjZBOTBCNThGRTZCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+54re4wAAASZQTFRFPj4+ODg4Ozs7zMzN1NTUVlZWPz8/Nzc3PT49QUFBaGdnRkVFbm5uPDw8jY2NOTk5RENDPT4+RERET1BQXFxcOjo6dHR0PT09ZmVlQ0JCUFBQY2RkRkZGOzw7QUBA1NPULzAwaWlpoqGivr2+09PUwcDAQkJBPz8+m5ubwsLDW1lZPz9Av7/A4+XmPDw74OHiZmRlQ0NDZWRkVVRUPTw8RURERUVFSUlJNjc3UVBQNjY1ioqKy8zN3+DhcG9vzMvMLC0swsHCn56ehIODnJybSEdHycrKjIuLysnKU1NTz87Pf39/jYyMNDQ0SkpKi4mJxMPEPj8/s7Oz2NjYaWhoa2pqTk5NkY+QX19foaCgQEA/hIKDZ2hoX2BgUVJSQEBAP0BA////jskvbQAAAGJ0Uk5T/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wAQVpKqAAAA6UlEQVR42mJIxAYYKBcVE45DB1I8DNIJmECEIQaLaCxCNB4I2AQRokAugzgHEIhzmvLGx8NFRaNkuIFA0tLJnBcuysSj48UMBvpBQoJQUTZ1TTdrHz4+PvfwYCW5QLAo0FBOD2cHdiDwFfAXNYmHi9pHW4GcEM/JL+HKBhOVcfHTA4syhgaYMUBF49VkjQX4mYBAwdvGkAHuBgnlCE9WIAjTYJaEiQoKqOqqyLOAgG0krzbMx0yKjnYGXEAQYiTEAPNFQjy/lpwFIxgwxCNE42XZ4mEAEWbxSAAsKo0sCg917DFEo/QAEGAAxRqwTIYyEikAAAAASUVORK5CYII=\"/>
            <span class=\"sf-toolbar-info-piece-additional-detail\">Routing</span>
        ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 9
            echo "        ";
            ob_start();
            // line 10
            echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Routes</b>
                <span>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "routecount", array()), "html", null, true);
            echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Resources</b>
                <span>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "ressourcecount", array()), "html", null, true);
            echo "</span>
            </div>
        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 19
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
            // line 20
            echo "    ";
        }
    }

    // line 23
    public function block_menu($context, array $blocks = array())
    {
        // line 24
        echo "    <span class=\"label\">
        <span class=\"icon\">
            <img width=30 src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAqCAYAAAAnH9IiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MzBCQTQ1NjM0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MzBCQTQ1NjQ0QkM1MTFFMEE4QjFCOTM4QzI2QzNENjIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozMEJBNDU2MTRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozMEJBNDU2MjRCQzUxMUUwQThCMUI5MzhDMjZDM0Q2MiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PmcZMmUAAAR/SURBVHja7Flba1xVFP72OfvMZDLJJKmxtGhuGqN9l7ZYmkkbK0VaMD7YKhX0RWqLj/WnWItQRlGwgn0Q6YUGUyQJIWArhYKNaZuXJNZEx1zmkjmX7Vp7hiDBxtknZ2QC3cmawJCzz7fX/r71rX2OSA8MDANop3iJIk8hUJ/DoZijWJT00VyJeCXqeaQoShZ9qEpsh6FxWtiG4wnoJ6A3GTLqCYWpqqIGXbOCrRQCCsuyQi3o/6cHg7VtxBwHQRBsD067vo/GRAOODA6iNZXCWqlUW04zXXzKjk835u1VypyVruchny/g5b370NndjUwmg+XVVcRjsehBC0Jccj0NvH1HG3a2Pw0ppTFwj0AnGhN6vn2vHECxUMClby5p4DEnFi1oj7KbamrC60eP4sU9e9DR1Q2HeBki2SQyEiLN5xI1Dg4cogUIXL78LbJLy7CJ79GAZmT0O5BO49gbQ+v00KKwRBgtQhFQ3iWeq//wIOZmZ/HdlStbAy02iGdHSwvSlBXXdfV3S39l8eu9e3q7NytdGwdnWMbi6OvrQ6q1VYOcGB3F6NgYHCnN6CE2qY2cEWlbmg5CWMj+uYjPPj2PX6an6UaOUT13PRfNySTOnDmLnbt24ceREWS+yKBYLJJGHHNOiyrcyybwMw8eYOr+fcqyT9eY0YPF7AcKKdq5yfFxZD7PoECAq81yaBsXRAdpS+JjYESN8qJtDXByYgIjN28iR9WD5+DdZEHWDjT/CBGqe3AINAP9nkTHWuHRsXs3imtr+CObrUqI5o5IYIPAr1hwiO6ErueK4dMcLOLnOjvwwenTSJBL+lXaulGmnZiD3+fnce3qVRSpxsZkuCaRd8nzAgLciQ/PfoSWtja9kI36UlvNNG/b4sICLpz/BHenprQgVcjm0vM9Pd+x48fxTEcHSkSNyHsPm4RSLK4hc/Eiph4+1B0aZ7nsbEHZ40N23iYCNMo0Z2Uln8P0zIy+VWuqGa+9egTJROO6mMwBh38AYFX/j+WKnGpK4u2T72Dv/v3aKLSlk4BMQq3/VY/1CFUtPdQmRsMZbUo24uRbJ3Cgvx9379zRXR63lI5jJkhuoXtIhD29z+taz3f2DQ4E8nErU/8AzuXpKeoT3hwawsFDh7XlPtvVhXPnPi6XPkNOcoZTdABoJldUKtC64J5GRClEtusXenspw2lNBxZPQ0MDNfE9WkRhDgP6sVYlu+Njo1heWa3KWKoGHaPt/5no8PVXX+LEqXe17ebzeSw8ekSLoC5PWKF0yIu9fesn/EB27tI8ji2rkqf8r2wIbQaWPstdHx7W35967338NjeLC9TpreZyutMzB600nwtUowOiiz4FRd0w8aR8erl24wbi8bg+4+XorLdE28ota9jBHiClbXSNkewlcc6jfFwn4PPzc5o2bDRSRv7MJ9ouj1tStuHJW7f1ImoBWEUNGhWOS1sY229Uj8qssJPUAnCkNl5vrwmsKLdtq7RQtRJirfkaOWhVR/QQqN93h/96cuBMr6D8/pDPPPX+8nOZ428BBgA7wPgIPxrUNQAAAABJRU5ErkJggg==\" />
        </span>
        <strong>Routing</strong>
        <span class=\"count\">
            <span>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "routecount", array()), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 35
    public function block_panel($context, array $blocks = array())
    {
        // line 36
        echo "
    <h2>Routes</h2>
    ";
        // line 38
        if ((!$this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "routecount", array()))) {
            // line 39
            echo "        <em>No route.</em>
    ";
        } else {
            // line 41
            echo "        <table>
            ";
            // line 42
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "routes", array()));
            foreach ($context['_seq'] as $context["i"] => $context["route"]) {
                // line 43
                echo "                <tr class=\"";
                echo ((($context["i"] % 2 == 1)) ? ("odd") : ("even"));
                echo "\" ";
                if (($this->getAttribute($context["route"], "name", array()) == $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "matchRoute", array()))) {
                    echo "style=\"color: red;\"";
                }
                echo ">
                    <th>
                        @";
                // line 45
                echo twig_escape_filter($this->env, $this->getAttribute($context["route"], "name", array()), "html", null, true);
                echo "
                    </th>
                    <td>
                        <code>";
                // line 48
                echo twig_escape_filter($this->env, $this->getAttribute($context["route"], "method", array()), "html", null, true);
                echo "</code>
                    </td>
                    <td>
                        <code>";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute($context["route"], "pattern", array()), "html", null, true);
                echo "</code>
                    </td>
                    <td>
                        <small>
                            <strong>Controller</strong>:       ";
                // line 55
                echo twig_escape_filter($this->env, $this->getAttribute($context["route"], "controller", array()), "html", null, true);
                echo "
                        </small>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['route'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "        </table>
    ";
        }
        // line 62
        echo "
    <h2>Sources</h2>

    ";
        // line 65
        if ((!$this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "ressourcecount", array()))) {
            // line 66
            echo "        <em>No source.</em>
    ";
        } else {
            // line 68
            echo "        <table>
            ";
            // line 69
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "ressources", array()));
            foreach ($context['_seq'] as $context["i"] => $context["ressource"]) {
                // line 70
                echo "                <tr class=\"";
                echo ((($context["i"] % 2 == 1)) ? ("odd") : ("even"));
                echo "\">
                    <th>
                        ";
                // line 72
                echo twig_escape_filter($this->env, $this->getAttribute($context["ressource"], "type", array()), "html", null, true);
                echo "
                    </th>
                    <td>
                        <code>";
                // line 75
                echo twig_escape_filter($this->env, $this->getAttribute($context["ressource"], "path", array()), "html", null, true);
                echo "</code>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['ressource'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "        </table>
    ";
        }
        // line 81
        echo "
";
    }

    public function getTemplateName()
    {
        return "WebProfilerExtraBundle:Collector:routing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 81,  192 => 79,  182 => 75,  176 => 72,  170 => 70,  166 => 69,  163 => 68,  159 => 66,  157 => 65,  152 => 62,  148 => 60,  137 => 55,  130 => 51,  124 => 48,  118 => 45,  108 => 43,  104 => 42,  101 => 41,  97 => 39,  95 => 38,  91 => 36,  88 => 35,  80 => 30,  72 => 24,  69 => 23,  64 => 20,  61 => 19,  55 => 16,  48 => 12,  44 => 10,  41 => 9,  36 => 5,  33 => 4,  30 => 3,);
    }
}
