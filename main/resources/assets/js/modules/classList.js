export default {
    hasClass(elem, className) {
        if (elem.classList) {
            return elem.classList.contains(className);
        } else {
            return new RegExp('(^|\\s)' + className + '(\\s|$)').test(elem.className);
        }
    },

    addClass(elem, className) {
        if (!this.hasClass(elem, className)) {
            if (elem.classList) {
                elem.classList.add(className);
            } else {
                elem.className += (elem.className ? ' ' : '') + className;
            }
        }
    },

    removeClass(elem, className) {
        if (this.hasClass(elem, className)) {
            if (elem.classList) {
                elem.classList.remove(className);
            } else {
                elem.className = elem.className.replace(new RegExp('(^|\\s)*' + className + '(\\s|$)*', 'g'), '');
            }
        }
    },

    toggleClass(elem, className) {
        if (elem.classList) {
            elem.classList.toggle(className);
        } else {
            if (this.hasClass(elem, className)) {
                elem.removeClass(className);
            } else {
                elem.addClass(className);
            }
        }
    }
}

