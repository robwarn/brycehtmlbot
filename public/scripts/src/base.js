Element.prototype.appendBefore = function(element) {
	element.parentNode.insertBefore(this, element);
},false;

Element.prototype.appendAfter = function(element) {
	element.parentNode.insertBefore(this, element.nextSibling);
},false;

Element.prototype.getParentBySelector = function(selector) {
	if (!Element.prototype.matches) {
		Element.prototype.matches =
		Element.prototype.matchesSelector ||
		Element.prototype.mozMatchesSelector ||
		Element.prototype.msMatchesSelector ||
		Element.prototype.oMatchesSelector ||
		Element.prototype.webkitMatchesSelector ||
		function(s) {
			var matches = (this.document || this.ownerDocument).querySelectorAll(s),
					i = matches.length;
			while (--i >= 0 && matches.item(i) !== this) {}
			return i > -1;
		};
	}
	let element = this;
	if (element) {
		while (!element.parentNode.matches(selector)) {
			if (!element) { return null; }
			element = element.parentNode;
		}
		return element.parentNode;
	}
	return null;
}, false;

Element.prototype.toggleAttribute = function(attr, on, off) {
	var attr = attr || 'data-state';
	var on = on || 'is-active';
	var off = off || 'is-inactive';
	if (this.getAttribute(attr) == on) {
		this.setAttribute(attr, off);
	} else {
		this.setAttribute(attr, on);
	}
}

NodeList.prototype.addEventListnerAll = function(event, func) {
	const nodeList = this;
	for (var i = 0; i < nodeList.length; i++) {
		nodeList[i].addEventListener(event, func, false);
	}
}

NodeList.prototype.removeEventListnerAll = function(event, func) {
	const nodeList = this;
	for (var i = 0; i < nodeList.length; i++) {
		nodeList[i].removeEventListener(event, func, false);
	}
}

const _ = selector => document.querySelector(selector);
const _All = selector => document.querySelectorAll(selector);
