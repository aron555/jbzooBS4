/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

!function(n){function o(){}n.extend(o.prototype,{name:"Calendar",options:{translations:[],timepicker_translations:[]},initialize:function(t,i){this.options=n.extend({},this.options,i);n.datepicker.regional.xx=this.options.translations,n.datepicker.setDefaults(n.datepicker.regional.xx),t.delegate("img.zoo-calendar","click",function(){var t=n(this).prev("input");t.length&&("timepicker"==t.data("timepicker")?(n(this).data("initialized-timepicker")||(t.datetimepicker({showOn:"button",dateFormat:n.datepicker.ISO_8601,constrainInput:!1,timeFormat:"HH:mm:ss",showSecond:!1}),n(this).prevUntil("input").remove(),n(this).data("initialized-timepicker",!0)),t.datetimepicker("show")):(n(this).data("initialized-datepicker")||(t.datepicker({showOn:"button",dateFormat:n.datepicker.ISO_8601,constrainInput:!1}),n(this).prevUntil("input").remove(),n(this).data("initialized-datepicker",!0)),t.datepicker("show")))})}}),n.fn[o.prototype.name]=function(){var e=arguments,a=e[0]?e[0]:null;return this.each(function(){var t,i=n(this);o.prototype[a]&&i.data(o.prototype.name)&&"initialize"!=a?i.data(o.prototype.name)[a].apply(i.data(o.prototype.name),Array.prototype.slice.call(e,1)):!a||n.isPlainObject(a)?(t=new o,o.prototype.initialize&&t.initialize.apply(t,n.merge([i],e)),i.data(o.prototype.name,t)):n.error("Method "+a+" does not exist on jQuery."+o.name)})}}(jQuery);