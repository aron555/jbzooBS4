(function($) {
    var Plugin = function() {};
    $.extend(Plugin.prototype, {
        name: "Folders",
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

                    var value = input.val();
                    var path = li.data("path");

                    if (value.indexOf(path) == -1) {
                        if(value.length) {
                            input.focus().val(value + ',' + path).blur()
                        } else
                            input.focus().val(path).blur();

                        var name = input.attr('name').replace('[files]','[description_'+path.replace(/[.\/]/g,'_')+']');
                        var html = '<tr><td>Имя файла: <span>' + path +'</span>';
                        html += '<textarea name="'+ name +'" style="height:60px;width:300px;" title="Описание" placeholder="Описание"></textarea>';
                        html += '</td><td><button class="remove">удалить</button></td></tr>';
                        $('table#descriptions').append(html);
                    }
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
                input.val("");
                $('table#descriptions').html("");
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