
L.Icon.Glyph = L.Icon.extend({
	options: {
		iconSize: [28, 41],
		iconAnchor:  [12, 41],
		popupAnchor: [1, -34],
		shadowSize:  [41, 41],
 		//iconUrl: 'glyph-marker-icon-gray.png',
// 		iconSize: [35, 45],
// 		iconAnchor:   [17, 42],
// 		popupAnchor: [1, -32],
// 		shadowAnchor: [10, 12],
// 		shadowSize: [36, 16],
// 		bgPos: (Point)
		className: '',
		prefix: '',
		glyph: 'home',
		glyphColor: 'white',
		glyphSize: '11px',	// in CSS units
		glyphAnchor: [0, -7]	// In pixels, counting from the center of the image.
	},

	createIcon: function () {
		var div = document.createElement('div'),
			options = this.options;

		if (options.glyph) {
			div.appendChild(this._createGlyph());
		}

		this._setIconStyles(div, options.className);
		return div;
	},

	_createGlyph: function() {
		var glyphClass,
		    textContent,
		    options = this.options;

		if (!options.prefix) {
			glyphClass = '';
			textContent = options.glyph;
		} else if(options.glyph.slice(0, options.prefix.length+1) === options.prefix + "-") {
			glyphClass = options.glyph;
		} else {
			glyphClass = options.prefix + "-" + options.glyph;
		}

		var span = L.DomUtil.create('span', options.prefix + ' ' + glyphClass);
		span.style.fontSize = options.glyphSize;
		span.style.color = options.glyphColor;
		span.style.width = options.iconSize[0] + 'px';
		span.style.lineHeight = options.iconSize[1] + 'px';
		span.style.textAlign = 'center';
		span.style.marginLeft = options.glyphAnchor[0] + 'px';
		span.style.marginTop = options.glyphAnchor[1] + 'px';
		span.style.pointerEvents = 'none';

		if (textContent) {
			span.innerHTML = textContent;
			span.style.display = 'inline-block';
		}

		return span;
	},

	_setIconStyles: function (div, name) {
		if (name === 'shadow') {
			return L.Icon.prototype._setIconStyles.call(this, div, name);
		}

		var options = this.options,
		    size = L.point(options['iconSize']),
		    anchor = L.point(options.iconAnchor);

		if (!anchor && size) {
			anchor = size.divideBy(2, true);
		}

		div.className = 'leaflet-marker-icon leaflet-glyph-icon ' + name;
		var src = this._getIconUrl('icon');
		if (src) {
			div.style.backgroundImage = "url('" + src + "')";
		}

		if (options.bgPos) {
			div.style.backgroundPosition = (-options.bgPos.x) + 'px ' + (-options.bgPos.y) + 'px';
		}
		if (options.bgSize) {
			div.style.backgroundSize = (options.bgSize.x) + 'px ' + (options.bgSize.y) + 'px';
		}

		if (anchor) {
			div.style.marginLeft = (-anchor.x) + 'px';
			div.style.marginTop  = (-anchor.y) + 'px';
		}

		if (size) {
			div.style.width  = size.x + 'px';
			div.style.height = size.y + 'px';
		}
	}
});

L.icon.glyph = function (options) {
	return new L.Icon.Glyph(options);
};


// Base64-encoded version of glyph-marker-icon.png
//L.Icon.Glyph.prototype.options.iconUrl = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAApCAYAAADEZlLzAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAeZJREFUeNrEmL9Lw0AUx1N1FQv6B7hFcLCuTo5SwUlwcHSJi5SCgw617VTxD8gkKCiu4lDoUHB2sW528w9QsDgJaeL37Kte4yW5u9zhg8cjyd19+s39eC8tRFHkyFi92VxEKJGPrce8Xqu9yIxRSIMBUETYhx/CZ+EzgmYB/AN+BvcBfleGAbSLcA6fToCI7BO+B+C1NAwg1niHQKo2hLcB3MqEAXSHUNYEpQKnYqAjhM2cIIf6lzFeS6gMD9gqe3TM2yoU9uLKLhw7djXxGmkPLVuCufTWfpRVFJa3qrFxD3jYhmPX1niYaxnm/ln6tu1fYAPLnAEP61uG9XnYpWXYLQ9rW4bd/J4go0z7YOsVjjM5vxp9yromjY3XEuYznGEspc+ZXIVQVUzaZ6cG1QU0XuKm9inLmrAhjZeQqUeVUdWAOta/Gq+0kgqevHM3MVdZZ+MxPNQEhdRfqW7UVSdUlXXqVzTmLqB+WuX3K8K8AuwNqhZ089m2grqA2ut9WJC6Z8mygZ2BS3kztSexMkNq5+RSJqkuU5VKDeKlzF0go0paGalj9fqK4NETVJVMV1eifZe6r7Rh+PX3CN3Y7S7dt1I3ehnX5mBUS3TosiP7L0GeitjTUfVtbDWq+kmjsa7T70uAAQCrtgYROA9iFAAAAABJRU5ErkJggg==';


