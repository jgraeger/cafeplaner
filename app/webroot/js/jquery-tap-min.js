!function(a,b){"use strict";var c,d,e="._tap",f="._tapActive",g="tap",h=40,i=400,j="clientX clientY screenX screenY pageX pageY".split(" "),k={count:0,event:0},l=function(a,c){var d=c.originalEvent,e=b.Event(d);e.type=a;for(var f=0,g=j.length;g>f;f++)e[j[f]]=c[j[f]];return e},m=function(a){if(a.isTrigger)return!1;var b=k.event,c=Math.abs(a.pageX-b.pageX),d=Math.abs(a.pageY-b.pageY),e=Math.max(c,d);return a.timeStamp-b.timeStamp<i&&h>e&&(!b.touches||1===k.count)&&o.isTracking},n=function(a){if(0===a.type.indexOf("touch")){a.touches=a.originalEvent.changedTouches;for(var b=a.touches[0],c=0,d=j.length;d>c;c++)a[j[c]]=b[j[c]]}},o={isEnabled:!1,isTracking:!1,enable:function(){o.isEnabled||(o.isEnabled=!0,c=b(a.body).on("touchstart"+e,o.onStart).on("mousedown"+e,o.onStart).on("click"+e,o.onClick))},disable:function(){o.isEnabled&&(o.isEnabled=!1,c.off(e))},onStart:function(a){a.isTrigger||(n(a),a.touches&&(k.count=a.touches.length),o.isTracking||(o.isTracking=!0,k.event=a,a.touches?c.on("touchend"+e+f,o.onEnd).on("touchcancel"+e+f,o.onCancel):c.on("mouseup"+e+f,o.onEnd)))},onEnd:function(a){var c;a.isTrigger||(n(a),m(a)&&(c=l(g,a),d=c,b(k.event.target).trigger(c),a.preventDefault()),o.onCancel(a),c&&!c.isDefaultPrevented()&&a.touches&&k.event.target.click())},onCancel:function(a){a&&"touchcancel"===a.type&&a.preventDefault(),o.isTracking=!1,c.off(f)},onClick:function(a){return!a.isTrigger&&d&&d.isDefaultPrevented()&&d.target===a.target&&d.pageX===a.pageX&&d.pageY===a.pageY&&a.timeStamp-d.timeStamp<i?(d=null,!1):void 0}};b(a).ready(o.enable)}(document,jQuery);