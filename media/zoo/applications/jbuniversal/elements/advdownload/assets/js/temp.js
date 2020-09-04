/**
 * Created by zom on 04.11.14.
 */
/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */
(function($) {
    var Plugin = function() {};
    $.extend(Plugin.prototype, {
        name: "finder",
        initialize: function(element, options) {
            var $this = this;
            this.options = $.extend({
                url: "",
                path: "",
                open: "open",
                loading: "loading"
            }, options);
            element.data("path", this.options.path).bind("retrieve:finder", retrieve).trigger("retrieve:finder");

            function retrieve(e) {
                e.preventDefault();
                var item = $(this).closest("li", element);
                if (!item.length) {
                    item = element
                }
                if (item.hasClass($this.options.open)) {
                    item.removeClass($this.options.open).children("ul").slideUp()
                } else {
                    item.addClass($this.options.loading);
                    $.post($this.options.url, {
                        path: item.data("path")
                    }, function(data) {
                        item.removeClass($this.options.loading).addClass($this.options.open);
                        if (!data.length) return;
                        item.children().remove("ul");
                        item.append("<ul>").children("ul").hide();
                        $.each(data, function(i, val) {
                            item.children("ul").append($('<li><a href="#">' + val.name + "</a></li>").addClass(val.type).data("path", val.path))
                        });
                        item.find("ul a").bind("click", retrieve);
                        item.children("ul").slideDown()
                    }, "json")
                }
            }
        }
    });
    $.fn[Plugin.prototype.name] = function() {
        var args = arguments;
        var method = args[0] ? args[0] : null;
        return this.each(function() {
            var element = $(this);
            if (Plugin.prototype[method] && element.data(Plugin.prototype.name) && method != "initialize") {
                element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name), Array.prototype.slice.call(args, 1))
            } else if (!method || $.isPlainObject(method)) {
                var plugin = new Plugin;
                if (Plugin.prototype["initialize"]) {
                    plugin.initialize.apply(plugin, $.merge([element], args))
                }
                element.data(Plugin.prototype.name, plugin)
            } else {
                $.error("Method " + method + " does not exist on jQuery." + Plugin.name)
            }
        })
    }
})(jQuery);
(function($) {
    var Plugin = function() {};
    $.extend(Plugin.prototype, {
        name: "Directories",
        initialize: function(input, options) {
            this.options = $.extend({
                url: "",
                title: "Folders",
                mode: "folder",
                msgDelete: "Delete"
            }, options);
            var $this = this;
            var finder = $('<div class="finder" />').insertAfter(input).finder(this.options).delegate("a", "click", function(e) {
                finder.find("li").removeClass("selected");
                var li = $(this).parent().addClass("selected");
                if ($this.options.mode != "file" || li.hasClass("file")) {
                    var value = input.val()
                    if(input.val().length)!empty
                    input.focus().val(li.data("path")).blur()
                }
            });
            var widget = finder.dialog($.extend({
                autoOpen: false,
                resizable: false,
                open: function() {
                    widget.position({
                        of: handle,
                        my: "center top",
                        at: "center bottom"
                    })
                }
            }, this.options)).dialog("widget");
            var handle = $('<span title="' + this.options.title + '" class="' + this.options.mode + 's" />').insertAfter(input).bind("click", function() {
                finder.dialog(finder.dialog("isOpen") ? "close" : "open")
            });
            $('<span title="' + this.options.msgDelete + '" class="delete-file" />').insertAfter(handle).bind("click", function() {
                input.val("")
            });
            $("body").bind("click", function(event) {
                if (finder.dialog("isOpen") && !handle.is(event.target) && !widget.find(event.target).length) {
                    finder.dialog("close")
                }
            })
        }
    });
    $.fn[Plugin.prototype.name] = function() {
        var args = arguments;
        var method = args[0] ? args[0] : null;
        return this.each(function() {
            var element = $(this);
            if (Plugin.prototype[method] && element.data(Plugin.prototype.name) && method != "initialize") {
                element.data(Plugin.prototype.name)[method].apply(element.data(Plugin.prototype.name), Array.prototype.slice.call(args, 1))
            } else if (!method || $.isPlainObject(method)) {
                var plugin = new Plugin;
                if (Plugin.prototype["initialize"]) {
                    plugin.initialize.apply(plugin, $.merge([element], args))
                }
                element.data(Plugin.prototype.name, plugin)
            } else {
                $.error("Method " + method + " does not exist on jQuery." + Plugin.name)
            }
        })
    }
})(jQuery); // This is just a sample script. Paste your real code (javascript or HTML) here.

if ('this_is' == /an_example/) {
    of_beautifer();
} else {
    var a = b ? (c % d) : e[f];
}