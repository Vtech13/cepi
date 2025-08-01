/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@grafikart/drop-files-element/dist/drop-files-element.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@grafikart/drop-files-element/dist/drop-files-element.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function styleInject(css, ref) {
  if ( ref === void 0 ) ref = {};
  var insertAt = ref.insertAt;

  if (!css || typeof document === 'undefined') { return; }

  var head = document.head || document.getElementsByTagName('head')[0];
  var style = document.createElement('style');
  style.type = 'text/css';

  if (insertAt === 'top') {
    if (head.firstChild) {
      head.insertBefore(style, head.firstChild);
    } else {
      head.appendChild(style);
    }
  } else {
    head.appendChild(style);
  }

  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    style.appendChild(document.createTextNode(css));
  }
}

var css = ":root {\n  --drop-border-color: #EBEBF3;\n  --drop-border-color-hover: #68caf3;\n}\n.drop-files {\n  border: 2px dashed var(--drop-border-color);\n  border-radius: 3px;\n  position: relative;\n  transition: border .3s;\n  padding: 10px 5px;\n}\n\n.drop-files.is-hovered {\n  border-color: var(--drop-border-color-hover);\n}\n\n.drop-files__explanations {\n  padding: 40px 0;\n  text-align: center;\n}\n\n.drop-files__fake {\n  position: absolute;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  width: 100%;\n  height: 100%;\n  opacity: 0;\n}\n\n.drop-files.is-hovered input:last-child {\n  z-index: 3;\n}\n\n.drop-files__files {\n  display: flex;\n  flex-wrap: wrap;\n}\n\n.drop-files__file {\n  position: relative;\n  max-width: 100px;\n  width: 100%;\n  flex: none;\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n  align-items: center;\n  margin: 5px;\n  z-index: 2;\n}\n\n.drop-files__file em {\n  opacity: .75;\n  font-size: .9em;\n}\n\n.drop-files__file svg {\n  width: 50px;\n  height: 50px;\n}\n\n.drop-files__file img {\n  width: 100%;\n  height: 50px;\n  object-fit: cover;\n}\n\n.drop-files__fileinfo {\n  margin-top: .5rem;\n  display: flex;\n  align-items: flex-end;\n  width: 100%;\n}\n\n.drop-files__fileinfo span {\n  white-space: nowrap;\n  text-overflow: ellipsis;\n  overflow: hidden;\n}\n\n.drop-files__fileinfo em {\n  flex: none;\n  margin-left: auto;\n  transition: opacity .3s;\n}\n\n.drop-files__file:hover .drop-files__fileinfo em {\n  opacity: 0;\n}\n\n.drop-files__explanations strong {\n  display: block;\n  font-weight: 500;\n  font-size: 1.2rem;\n}\n\n.drop-files__explanations em {\n  display: block;\n  margin-top: 5px;\n  opacity: .75;\n  font-weight: 400;\n  font-size: .9rem;\n  font-style: normal;\n}\n\n.drop-files__explanations em:empty {\n  display: none;\n}\n\n.drop-files.has-files .drop-files__explanations {\n  position: absolute;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 0;\n  opacity: 0;\n  background-color: rgba(255, 255, 255, 0.8);\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n  align-items: center;\n  pointer-events: none;\n  transition: .3s;\n}\n\n.drop-files.has-files.is-hovered .drop-files__explanations {\n  opacity: 1;\n  z-index: 3;\n}\n\n.drop-files__delete {\n  box-sizing: border-box;\n  color: #E94962;\n  position: absolute;\n  bottom: 0;\n  right: 0;\n  padding-left: 5px;\n  padding-top: 5px;\n  width: 25px !important;\n  height: 25px !important;\n  transition: opacity .3s;\n  opacity: 0;\n  cursor: pointer;\n}\n\n.drop-files__file:hover .drop-files__delete {\n  opacity: 1;\n}\n\n";
styleInject(css);

function arrayToFileList(files) {
    const data = new ClipboardEvent('').clipboardData || new DataTransfer();
    files.forEach(file => data.items.add(file));
    return data.files;
}
function mergeFiles(files1, files2) {
    const files = [...files1];
    files2.forEach(file => {
        if (files.find(f => f.size === file.size && f.name === file.name) === undefined) {
            files.push(file);
        }
    });
    return files;
}
function mergeFileLists(files1, files2) {
    return arrayToFileList(mergeFiles(Array.from(files1), Array.from(files2)));
}
function diffFiles(oldFiles, newFiles) {
    if (oldFiles === null) {
        return [Array.from(newFiles), []];
    }
    const added = Array.from(newFiles).filter(f => !Array.from(oldFiles).includes(f));
    const removed = Array.from(oldFiles).filter(f => !Array.from(newFiles).includes(f));
    return [added, removed];
}
function removeFile(fileList, file) {
    return arrayToFileList(Array.from(fileList).filter(f => f !== file));
}

function strToDom(str) {
    return document.createRange().createContextualFragment(str);
}

function humanSize(size, precision = 2) {
    const i = Math.floor(Math.log(size) / Math.log(1024));
    return (size / Math.pow(1024, i)).toFixed(precision).toString() + ['o', 'ko', 'Mo', 'Go', 'To'][i];
}

var pdf = `<svg viewBox="0 0 32 32">
    <path d="M26.7062 9.02188C26.8937 9.20938 27 9.4625 27 9.72812V29C27 29.5531 26.5531 30 26 30H6C5.44687 30 5 29.5531 5 29V3C5 2.44687 5.44687 2 6 2H19.2719C19.5375 2 19.7938 2.10625 19.9813 2.29375L26.7062 9.02188V9.02188ZM24.6938 10.1875L18.8125 4.30625V10.1875H24.6938ZM19.7881 19.9144C19.3137 19.8988 18.8094 19.9353 18.2366 20.0069C17.4772 19.5384 16.9659 18.895 16.6028 17.9497L16.6362 17.8128L16.675 17.6509C16.8094 17.0844 16.8816 16.6709 16.9031 16.2541C16.9194 15.9394 16.9019 15.6491 16.8459 15.38C16.7428 14.7991 16.3319 14.4594 15.8141 14.4384C15.3312 14.4187 14.8875 14.6884 14.7741 15.1062C14.5894 15.7819 14.6975 16.6709 15.0891 18.1872C14.5903 19.3762 13.9312 20.7703 13.4891 21.5478C12.8987 21.8522 12.4391 22.1291 12.0528 22.4359C11.5434 22.8413 11.2253 23.2578 11.1378 23.6953C11.0953 23.8981 11.1594 24.1631 11.3053 24.3803C11.4709 24.6266 11.7203 24.7866 12.0194 24.8097C12.7741 24.8681 13.7016 24.09 14.7256 22.3328C14.8284 22.2984 14.9372 22.2622 15.07 22.2172L15.4419 22.0916C15.6772 22.0122 15.8478 21.9553 16.0166 21.9006C16.7478 21.6625 17.3009 21.5122 17.8041 21.4266C18.6784 21.8947 19.6891 22.2016 20.3697 22.2016C20.9316 22.2016 21.3112 21.9103 21.4484 21.4519C21.5687 21.0494 21.4734 20.5825 21.2147 20.3244C20.9472 20.0616 20.4553 19.9359 19.7881 19.9144V19.9144ZM12.0384 23.9275V23.9163L12.0425 23.9056C12.0882 23.7874 12.1469 23.6746 12.2175 23.5694C12.3512 23.3637 12.5353 23.1475 12.7634 22.9172C12.8859 22.7937 13.0134 22.6734 13.1631 22.5384C13.1966 22.5084 13.4103 22.3181 13.4503 22.2806L13.7994 21.9556L13.5456 22.3597C13.1606 22.9734 12.8125 23.4153 12.5144 23.7034C12.4047 23.8097 12.3081 23.8878 12.23 23.9381C12.2042 23.9554 12.1769 23.9702 12.1484 23.9825C12.1356 23.9878 12.1244 23.9909 12.1131 23.9919C12.1012 23.9934 12.0892 23.9918 12.0781 23.9872C12.0664 23.9823 12.0563 23.974 12.0493 23.9633C12.0422 23.9527 12.0384 23.9403 12.0384 23.9275V23.9275ZM15.9741 17.1063L15.9034 17.2313L15.8597 17.0944C15.7628 16.7872 15.6916 16.3244 15.6719 15.9069C15.6494 15.4319 15.6872 15.1469 15.8372 15.1469C16.0478 15.1469 16.1444 15.4844 16.1519 15.9922C16.1587 16.4384 16.0884 16.9028 15.9738 17.1063H15.9741ZM15.7925 18.9331L15.8403 18.8066L15.9056 18.9253C16.2709 19.5891 16.745 20.1428 17.2663 20.5287L17.3787 20.6119L17.2416 20.64C16.7312 20.7456 16.2559 20.9044 15.6059 21.1666C15.6738 21.1391 14.9303 21.4434 14.7422 21.5156L14.5781 21.5784L14.6656 21.4259C15.0516 20.7541 15.4081 19.9472 15.7922 18.9331H15.7925ZM20.7181 21.3162C20.4725 21.4131 19.9437 21.3266 19.0128 20.9291L18.7766 20.8284L19.0328 20.8097C19.7609 20.7556 20.2766 20.7956 20.5772 20.9056C20.7053 20.9525 20.7906 21.0116 20.8284 21.0791C20.8483 21.111 20.855 21.1495 20.8471 21.1863C20.8392 21.2231 20.8172 21.2553 20.7859 21.2763C20.7661 21.2938 20.7431 21.3073 20.7181 21.3162V21.3162Z" fill="#E94962"/>
</svg>`;

var doc = `<svg viewBox="0 0 16 16">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0308 0.0310059V3.96901H13.9018L10.0308 0.0310059Z" fill="#0078d7"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 9H4.965V10.989H4V9Z" fill="#0078d7"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9H8.953V10.953H8V9Z" fill="#0078d7"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.93799 5.09209V0.0690918H2.04199V15.9381H13.938V5.09209H8.93799ZM5.03299 11.0311V12.0401H2.98199V7.97309L5.04599 7.98309V8.95409H6.02999L6.04599 11.0321H5.03299V11.0311V11.0311ZM10.012 11.0471H9.01599V12.0311H7.96899V11.0471H6.97499V8.98509H7.96899V7.96909H9.01599V8.98509H10.012V11.0471ZM13.016 9.01609H12.016V10.9851H13.016V12.0001H11.954V11.0241H10.97V8.95709H11.954V7.97109H13.016V9.01609V9.01609Z" fill="#0078d7"/>
</svg>`;

const icons = {
    doc: doc,
    docx: doc,
    pdf: pdf,
};
/*
Element implicitly has an 'any' type because expression of type 'string' can't be used to index type '{ doc: string; docx: string; pdf: string; }'.
  No index signature with a parameter of type 'string' was found on type '{ doc: string; docx: string; pdf: string; }'.

 */
function renderExtension(file) {
    const ext = file.name
        .split('.')
        .slice(-1)[0]
        .toLowerCase();
    if (icons[ext] !== undefined) {
        return strToDom(icons[ext]).firstChild;
    }
    const img = strToDom(`<img src=""/>`).firstChild;
    const reader = new FileReader();
    reader.addEventListener('load', () => {
        img.setAttribute('src', reader.result.toString());
    }, false);
    reader.readAsDataURL(file);
    return img;
}

function FileComponent({ file, onDelete }) {
    const icon = renderExtension(file);
    const dom = strToDom(`<div class="drop-files__file">
    <div class="drop-files__fileinfo">
      <span>${file.name}</span>
      <em>${humanSize(file.size, 0)}</em>
    </div>
    <svg width="24" height="24" viewBox="0 0 24 24" class="drop-files__delete">
      <path
        d="M4 5H7V4C7 3.46957 7.21071 2.96086 7.58579 2.58579C7.96086 2.21071 8.46957 2 9 2H15C15.5304 2 16.0391 2.21071 16.4142 2.58579C16.7893 2.96086 17 3.46957 17 4V5H20C20.2652 5 20.5196 5.10536 20.7071 5.29289C20.8946 5.48043 21 5.73478 21 6C21 6.26522 20.8946 6.51957 20.7071 6.70711C20.5196 6.89464 20.2652 7 20 7H19V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V7H4C3.73478 7 3.48043 6.89464 3.29289 6.70711C3.10536 6.51957 3 6.26522 3 6C3 5.73478 3.10536 5.48043 3.29289 5.29289C3.48043 5.10536 3.73478 5 4 5V5ZM7 7V20H17V7H7ZM9 5H15V4H9V5ZM9 9H11V18H9V9ZM13 9H15V18H13V9Z"
      fill="currentColor"/>
      </svg>
    </div>`).firstChild;
    dom.insertBefore(icon, dom.firstChild);
    dom.querySelector('.drop-files__delete').addEventListener('click', e => {
        e.preventDefault();
        onDelete(file);
    });
    return dom;
}

/**
 * Flip animation
 */
class Flip {
    constructor() {
        this.timingFunction = 'cubic-bezier(0.5, 0, 0, 0.5)';
        this.duration = 450;
        this.positions = new Map();
    }
    /**
     * Mémorise la position de nos éléments
     */
    read(elements) {
        elements.forEach(element => {
            this.positions.set(element, element.getBoundingClientRect());
        });
    }
    /**
     * Anime les éléments vers leur nouvelle position
     */
    play(elements) {
        elements.forEach((element, k) => {
            const newPosition = element.getBoundingClientRect();
            const oldPosition = this.positions.get(element);
            if (oldPosition === undefined) {
                element.animate([
                    {
                        transform: `translate(0, 10px)`,
                        opacity: 0,
                    },
                    {
                        transform: 'none',
                        opacity: 1,
                    },
                ], {
                    duration: this.duration,
                    easing: this.timingFunction,
                    fill: 'both',
                    delay: 50 * k,
                });
                return;
            }
            const deltaX = oldPosition.x - newPosition.x;
            const deltaY = oldPosition.y - newPosition.y;
            const deltaW = oldPosition.width / newPosition.width;
            const deltaH = oldPosition.height / newPosition.height;
            if (deltaX === 0 && deltaY === 0 && deltaH === 0 && deltaW === 0)
                return;
            element.animate([
                {
                    transform: `translate(${deltaX}px, ${deltaY}px) scale(${deltaW}, ${deltaH})`,
                },
                {
                    transform: 'none',
                },
            ], {
                duration: this.duration,
                easing: this.timingFunction,
                fill: 'both',
            });
        });
    }
    /**
     * Supprime les éléments avec une animation
     *
     * @param {Element[]} elements
     */
    remove(elements) {
        // We move the elements to remove at the end
        elements.forEach(element => element.parentNode.appendChild(element));
        // We animate the removal of the element
        elements.forEach(element => {
            const newPosition = element.getBoundingClientRect();
            const oldPosition = this.positions.get(element);
            const deltaX = oldPosition.x - newPosition.x;
            const deltaY = oldPosition.y - newPosition.y;
            element.animate([
                {
                    transform: `translate(${deltaX}px, ${deltaY}px)`,
                    opacity: 1,
                },
                {
                    transform: `translate(${deltaX}px, ${deltaY - 10}px)`,
                    opacity: 0,
                },
            ], {
                duration: this.duration,
                easing: this.timingFunction,
                fill: 'both',
            });
            window.setTimeout(function () {
                element.parentNode.removeChild(element);
            }, this.duration);
        });
    }
}

/**
 * This component handle the view for the file listing
 */
class FileListComponent {
    constructor() {
        this.oldFiles = null;
    }
    render({ onDelete }) {
        this.flip = new Flip();
        this.onDelete = onDelete;
        this.fileElements = new Map();
        this.container = strToDom(`<div class="drop-files__files"></div>`).firstChild;
        return this.container;
    }
    /**
     * Update the DOM
     */
    update(fileList) {
        const [added, removed] = diffFiles(this.oldFiles, fileList);
        this.flip.read(Array.from(this.fileElements.values()));
        added.forEach(file => {
            const fileComponent = FileComponent({ file, onDelete: this.onDelete });
            this.fileElements.set(file, fileComponent);
            this.container.appendChild(fileComponent);
        });
        if (removed.length > 0) {
            const removeElements = removed.map(file => {
                const element = this.fileElements.get(file);
                this.fileElements.delete(file);
                return element;
            });
            this.flip.remove(removeElements);
        }
        this.flip.play(Array.from(this.fileElements.values()));
        this.oldFiles = arrayToFileList(Array.from(fileList)); // Creates a clone instead of a reference, fix #2
    }
}

/**
 * @element drop-files
 * @attr {String} label - The label used as a bold text for the drop area
 * @attr {String} help - Help text used as a secondary text for the drop area
 * @cssprop --drop-border-color
 * @cssprop --drop-border-color-hover
 */
class DropFilesElement extends HTMLInputElement {
    constructor() {
        super(...arguments);
        this.ignoreCallbacks = false;
        this.allowMultiple = false;
    }
    static get observedAttributes() {
        return ['label', 'help', 'multiple'];
    }
    connectedCallback() {
        if (this.ignoreCallbacks)
            return;
        this.ignoreCallbacks = true;
        const div = this.render();
        this.fileList = new FileListComponent();
        this.insertAdjacentElement('afterend', div);
        this.style.display = 'none';
        div.appendChild(this);
        div.appendChild(this.fileList.render({ onDelete: this.deleteFile.bind(this) }));
        // Listeners
        div.addEventListener('dragover', () => div.classList.add('is-hovered'));
        div.addEventListener('dragleave', () => div.classList.remove('is-hovered'));
        div.addEventListener('drop', () => div.classList.remove('is-hovered'));
        this.container = div;
        // Safari need this timer
        window.requestAnimationFrame(() => {
            this.ignoreCallbacks = false;
        });
        if (this.files.length > 0) {
            this.onFilesUpdate();
        }
    }
    disconnectedCallback() {
        if (this.ignoreCallbacks)
            return;
        this.container.remove();
    }
    attributeChangedCallback(name, oldValue, newValue) {
        if (name === 'label' && this.container) {
            this.container.querySelector('.drop-files__explanations strong').innerHTML = newValue;
        }
        if (name === 'help' && this.container) {
            this.container.querySelector('.drop-files__explanations em').innerHTML = newValue;
        }
        if (name === 'multiple') {
            this.allowMultiple = newValue !== null;
            if (!this.allowMultiple && this.files.length > 1) {
                this.files = arrayToFileList([this.files[0]]);
                this.onFilesUpdate();
            }
        }
    }
    getAttributes() {
        return {
            label: this.getAttribute('label') || 'Drop files here or click to upload.',
            help: this.getAttribute('help') || '',
        };
    }
    /**
     * Render the base structure for the component
     */
    render() {
        const { label, help } = this.getAttributes();
        const dom = strToDom(`<div class="drop-files">
      <div class="drop-files__explanations">
            <strong>${label}</strong>
            <em>${help}</em>
      </div>
      <input type="file" multiple class="drop-files__fake"/>
    </div>`).firstElementChild;
        dom.querySelector('.drop-files__fake').addEventListener('change', this.onNewFiles.bind(this));
        return dom;
    }
    /**
     * Remove a file from the FileList
     */
    deleteFile(file) {
        this.files = removeFile(this.files, file);
        this.onFilesUpdate();
    }
    /**
     * Event triggered when new files are selected
     */
    onNewFiles(e) {
        if (this.allowMultiple) {
            this.files = mergeFileLists(this.files, e.currentTarget.files);
        }
        else {
            this.files = arrayToFileList([e.currentTarget.files[0]]);
        }
        e.currentTarget.files = arrayToFileList([]);
        this.onFilesUpdate();
    }
    /**
     * Event triggered when files changes
     */
    onFilesUpdate() {
        this.dispatchEvent(new Event('change'));
        if (this.files.length > 0) {
            this.container.classList.add('has-files');
        }
        else {
            this.container.classList.remove('has-files');
        }
        this.fileList.update(this.files);
    }
}
try {
    customElements.define('drop-files', DropFilesElement, { extends: 'input' });
}
catch (e) {
    if (e instanceof DOMException) {
        console.error('DOMException : ' + e.message);
    }
    else {
        throw e;
    }
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (DropFilesElement);


/***/ }),

/***/ "./resources/assets/js/modules/classList.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/modules/classList.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  hasClass: function hasClass(elem, className) {
    if (elem.classList) {
      return elem.classList.contains(className);
    } else {
      return new RegExp('(^|\\s)' + className + '(\\s|$)').test(elem.className);
    }
  },
  addClass: function addClass(elem, className) {
    if (!this.hasClass(elem, className)) {
      if (elem.classList) {
        elem.classList.add(className);
      } else {
        elem.className += (elem.className ? ' ' : '') + className;
      }
    }
  },
  removeClass: function removeClass(elem, className) {
    if (this.hasClass(elem, className)) {
      if (elem.classList) {
        elem.classList.remove(className);
      } else {
        elem.className = elem.className.replace(new RegExp('(^|\\s)*' + className + '(\\s|$)*', 'g'), '');
      }
    }
  },
  toggleClass: function toggleClass(elem, className) {
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
});

/***/ }),

/***/ "./resources/assets/js/modules/disabledFormSubmitBtnWhenSend.js":
/*!**********************************************************************!*\
  !*** ./resources/assets/js/modules/disabledFormSubmitBtnWhenSend.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "disabledFormSubmitBtnWhenSend": () => (/* binding */ disabledFormSubmitBtnWhenSend)
/* harmony export */ });
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function disabledFormSubmitBtnWhenSend() {
  var _iterator = _createForOfIteratorHelper(document.forms),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var form = _step.value;
      form.addEventListener('submit', function (e) {
        var button = e.target.querySelector('button[type="submit"]');
        var input = e.target.querySelector('input[type="submit"]');

        if (button) {
          button.disabled = true;
        }

        if (input) {
          input.disabled = true;
        }
      });
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
}

/***/ }),

/***/ "./resources/assets/js/modules/slide.js":
/*!**********************************************!*\
  !*** ./resources/assets/js/modules/slide.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  slideUp: function slideUp(target) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    target.style.height = target.offsetHeight + 'px';
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    window.setTimeout(function () {
      target.style.display = 'none';
      target.style.removeProperty('height');
      target.style.removeProperty('padding-top');
      target.style.removeProperty('padding-bottom');
      target.style.removeProperty('margin-top');
      target.style.removeProperty('margin-bottom');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
  },
  slideDown: function slideDown(target) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
    target.style.removeProperty('display');
    var display = window.getComputedStyle(target).display;
    if (display === 'none') display = 'block';
    target.style.display = display;
    var height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    target.offsetHeight;
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.style.height = height + 'px';
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    window.setTimeout(function () {
      target.style.removeProperty('height');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
  },
  slideToggle: function slideToggle(target) {
    var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

    if (window.getComputedStyle(target).display === 'none') {
      return this.slideDown(target, duration);
    } else {
      return this.slideUp(target, duration);
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/modules/tabs.js":
/*!*********************************************!*\
  !*** ./resources/assets/js/modules/tabs.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "tab": () => (/* binding */ tab)
/* harmony export */ });
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function tab() {
  var tabLinks = document.querySelectorAll('.tab__link');

  var _iterator = _createForOfIteratorHelper(tabLinks),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var tabLink = _step.value;
      tabLink.addEventListener('click', function (e) {
        e.preventDefault();
        tabLinks.forEach(function (el) {
          el.parentElement.classList.remove('sidebar__list-item--active');
        });
        document.querySelectorAll('.tab__content').forEach(function (el) {
          el.style.display = 'none';
        });
        e.target.parentElement.classList.add('sidebar__list-item--active');
        localStorage.setItem('tab-selected', e.target.dataset.id);
        document.getElementById(e.target.dataset.id).style.display = 'block';
      });
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
}

/***/ }),

/***/ "./node_modules/basiclightbox/dist/basicLightbox.min.js":
/*!**************************************************************!*\
  !*** ./node_modules/basiclightbox/dist/basicLightbox.min.js ***!
  \**************************************************************/
/***/ ((module) => {

!function(e){if(true)module.exports=e();else {}}((function(){return function e(n,t,o){function r(c,u){if(!t[c]){if(!n[c]){var s=undefined;if(!u&&s)return require(c,!0);if(i)return i(c,!0);var a=new Error("Cannot find module '"+c+"'");throw a.code="MODULE_NOT_FOUND",a}var l=t[c]={exports:{}};n[c][0].call(l.exports,(function(e){return r(n[c][1][e]||e)}),l,l.exports,e,n,t,o)}return t[c].exports}for(var i=undefined,c=0;c<o.length;c++)r(o[c]);return r}({1:[function(e,n,t){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.create=t.visible=void 0;var o=function(e){var n=arguments.length>1&&void 0!==arguments[1]&&arguments[1],t=document.createElement("div");return t.innerHTML=e.trim(),!0===n?t.children:t.firstChild},r=function(e,n){var t=e.children;return 1===t.length&&t[0].tagName===n},i=function(e){return null!=(e=e||document.querySelector(".basicLightbox"))&&!0===e.ownerDocument.body.contains(e)};t.visible=i;t.create=function(e,n){var t=function(e,n){var t=o('\n\t\t<div class="basicLightbox '.concat(n.className,'">\n\t\t\t<div class="basicLightbox__placeholder" role="dialog"></div>\n\t\t</div>\n\t')),i=t.querySelector(".basicLightbox__placeholder");e.forEach((function(e){return i.appendChild(e)}));var c=r(i,"IMG"),u=r(i,"VIDEO"),s=r(i,"IFRAME");return!0===c&&t.classList.add("basicLightbox--img"),!0===u&&t.classList.add("basicLightbox--video"),!0===s&&t.classList.add("basicLightbox--iframe"),t}(e=function(e){var n="string"==typeof e,t=e instanceof HTMLElement==1;if(!1===n&&!1===t)throw new Error("Content must be a DOM element/node or string");return!0===n?Array.from(o(e,!0)):"TEMPLATE"===e.tagName?[e.content.cloneNode(!0)]:Array.from(e.children)}(e),n=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(null==(e=Object.assign({},e)).closable&&(e.closable=!0),null==e.className&&(e.className=""),null==e.onShow&&(e.onShow=function(){}),null==e.onClose&&(e.onClose=function(){}),"boolean"!=typeof e.closable)throw new Error("Property `closable` must be a boolean");if("string"!=typeof e.className)throw new Error("Property `className` must be a string");if("function"!=typeof e.onShow)throw new Error("Property `onShow` must be a function");if("function"!=typeof e.onClose)throw new Error("Property `onClose` must be a function");return e}(n)),c=function(e){return!1!==n.onClose(u)&&function(e,n){return e.classList.remove("basicLightbox--visible"),setTimeout((function(){return!1===i(e)||e.parentElement.removeChild(e),n()}),410),!0}(t,(function(){if("function"==typeof e)return e(u)}))};!0===n.closable&&t.addEventListener("click",(function(e){e.target===t&&c()}));var u={element:function(){return t},visible:function(){return i(t)},show:function(e){return!1!==n.onShow(u)&&function(e,n){return document.body.appendChild(e),setTimeout((function(){requestAnimationFrame((function(){return e.classList.add("basicLightbox--visible"),n()}))}),10),!0}(t,(function(){if("function"==typeof e)return e(u)}))},close:c};return u}},{}]},{},[1])(1)}));

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*****************************************!*\
  !*** ./resources/assets/js/platform.js ***!
  \*****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_disabledFormSubmitBtnWhenSend__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/disabledFormSubmitBtnWhenSend */ "./resources/assets/js/modules/disabledFormSubmitBtnWhenSend.js");
/* harmony import */ var _modules_slide__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/slide */ "./resources/assets/js/modules/slide.js");
/* harmony import */ var _modules_classList__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/classList */ "./resources/assets/js/modules/classList.js");
/* harmony import */ var _grafikart_drop_files_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @grafikart/drop-files-element */ "./node_modules/@grafikart/drop-files-element/dist/drop-files-element.js");
/* harmony import */ var basiclightbox__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! basiclightbox */ "./node_modules/basiclightbox/dist/basicLightbox.min.js");
/* harmony import */ var basiclightbox__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(basiclightbox__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _modules_tabs__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/tabs */ "./resources/assets/js/modules/tabs.js");
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }







(0,_modules_disabledFormSubmitBtnWhenSend__WEBPACK_IMPORTED_MODULE_0__.disabledFormSubmitBtnWhenSend)();
removeFlashMessage();
/**
 * Dropdown element
 */

if (document.querySelectorAll('.dropdown__button').length > 0) {
  dropdownBtn(document.querySelectorAll('.dropdown__button'));
}

document.addEventListener('mouseup', function (e) {
  dropdownBtnClose(e);
});
/**
 * Table responsive
 */

if (document.querySelectorAll('.table-responsive')) {
  setTableResponsive(document.querySelectorAll('.table-responsive'));
}

if (document.querySelector('#search-filter')) {
  document.querySelector('#search-filter').addEventListener('keyup', filterTable, false);
}

if (document.querySelector('#search-filter-li')) {
  document.querySelector('#search-filter-li').addEventListener('keyup', filterLi, false);
}

if (document.getElementById('forgot-password')) {
  document.getElementById('forgot-password').addEventListener('click', function (e) {
    e.preventDefault();
    var containerForgot = document.getElementById('container-forgot-password');
    _modules_slide__WEBPACK_IMPORTED_MODULE_1__["default"].slideToggle(containerForgot);
  });
}

if (document.querySelector('.js__attachment-delete')) {
  var _iterator = _createForOfIteratorHelper(document.querySelectorAll('.js__attachment-delete')),
      _step;

  try {
    var _loop = function _loop() {
      var btnDelete = _step.value;
      btnDelete.addEventListener('click', function (e) {
        e.preventDefault();

        if (confirm('Êtes-vous sûr de vouloir supprimer ce media ?')) {
          fetch(btnDelete.dataset.url, {
            headers: defineHeaderForForm('post'),
            method: 'DELETE'
          }).then(function (response) {
            return response.json();
          }).then(function (res) {
            document.getElementById('attachment-' + btnDelete.dataset.id).style.display = 'none';
          })["catch"](function (err) {
            console.error(err.message);
          });
        }
      });
    };

    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      _loop();
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
}
/**
 * Lightbox
 */


if (document.querySelectorAll('.js__lightbox-btn').length > 0) {
  lightbox(document.querySelectorAll('.js__lightbox-btn'));
}

if (document.querySelector('.tab__link')) {
  (0,_modules_tabs__WEBPACK_IMPORTED_MODULE_5__.tab)();

  if (localStorage.getItem('tab-selected') && document.querySelector('[data-id=' + localStorage.getItem('tab-selected') + ']')) {
    document.querySelector('[data-id=' + localStorage.getItem('tab-selected') + ']').click();
  } else {
    document.querySelector('.tab__link').click();
  }
}
/**
 * Delete confrere
 * -------------------
 */


if (document.querySelectorAll('.js__delete-confrere').length > 0) {
  var _iterator2 = _createForOfIteratorHelper(document.querySelectorAll('.js__delete-confrere')),
      _step2;

  try {
    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
      var btn = _step2.value;
      btn.addEventListener('click', function (e) {
        e.preventDefault();

        if (confirm('Êtes-vous sur de vouloir supprimer ce confrère ?')) {
          document.getElementById(this.dataset.id).submit();
        }
      });
    }
  } catch (err) {
    _iterator2.e(err);
  } finally {
    _iterator2.f();
  }
}

if (document.querySelectorAll('.js__delete-patient').length > 0) {
  var _iterator3 = _createForOfIteratorHelper(document.querySelectorAll('.js__delete-patient')),
      _step3;

  try {
    for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
      var _btn = _step3.value;

      _btn.addEventListener('click', function (e) {
        e.preventDefault();

        if (confirm('Êtes-vous sur de vouloir supprimer ce patient ?')) {
          document.getElementById(this.dataset.id).submit();
        }
      });
    }
  } catch (err) {
    _iterator3.e(err);
  } finally {
    _iterator3.f();
  }
}
/**
 * =====================
 * --FUNCTIONS
 * =====================
 */

/**
 * Remove flash message after 15 second
 */


function removeFlashMessage() {
  if (document.getElementById('flashMessage')) {
    setTimeout(function () {
      if (document.getElementById('flashMessage')) {
        _modules_slide__WEBPACK_IMPORTED_MODULE_1__["default"].slideUp(document.getElementById('flashMessage'), 800);
      }
    }, 15000);
  }
}
/**
 * Dropdown btn - dropdown menu
 * @param {NodeListOf<Element>} dropdownButton
 */


function dropdownBtn(dropdownButton) {
  var _iterator4 = _createForOfIteratorHelper(dropdownButton),
      _step4;

  try {
    for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
      var _btn2 = _step4.value;

      _btn2.addEventListener('click', function () {
        var content = document.querySelector('.dropdown__content');

        if (_modules_classList__WEBPACK_IMPORTED_MODULE_2__["default"].hasClass(content, 'open')) {
          _modules_classList__WEBPACK_IMPORTED_MODULE_2__["default"].removeClass(content, 'open');
        } else {
          content.classList.add('open');
        }
      });
    }
  } catch (err) {
    _iterator4.e(err);
  } finally {
    _iterator4.f();
  }
}

function dropdownBtnClose(e) {
  var content = document.querySelector('.dropdown__content.open');

  if (content !== null && !_modules_classList__WEBPACK_IMPORTED_MODULE_2__["default"].hasClass(e.target, 'dropdown__button')) {
    _modules_classList__WEBPACK_IMPORTED_MODULE_2__["default"].removeClass(content, 'open');
  }
}

function setTableResponsive(table) {
  table.forEach(function (table) {
    var labels = Array.from(table.querySelectorAll('th')).map(function (th) {
      return th.innerText;
    });
    table.querySelectorAll('td').forEach(function (td, i) {
      td.setAttribute('data-label', labels[i % labels.length]);
    });
  });
}

function filterTable(event) {
  var filter = event.target.value.toUpperCase();
  var rows = document.querySelector("#table tbody").rows;

  for (var i = 0; i < rows.length; i++) {
    var firstCol = rows[i].cells[0].textContent.toUpperCase();
    var secondCol = rows[i].cells[1].textContent.toUpperCase();
    var thirdCol = rows[i].cells[2].textContent.toUpperCase();
    var fourthCol = rows[i].cells[3].textContent.toUpperCase();
    var fifthCol = rows[i].cells[4].textContent.toUpperCase();

    if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || fourthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}

function filterLi(event) {
  var filter = event.target.value.toUpperCase();
  var rows = document.querySelectorAll(".sidebar__list-item");

  var _iterator5 = _createForOfIteratorHelper(rows),
      _step5;

  try {
    for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
      var item = _step5.value;
      var value = item.textContent.toUpperCase();

      if (value.indexOf(filter) > -1) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    }
  } catch (err) {
    _iterator5.e(err);
  } finally {
    _iterator5.f();
  }
}

function defineHeaderForForm() {
  var method = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'get';
  var myHeaders = new Headers();
  myHeaders.append('X-Requested-With', 'XMLHttpRequest');

  if (method === 'post') {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    myHeaders.append('X-CSRF-TOKEN', csrfToken);
  }

  return myHeaders;
}
/**
 * Display lightbox
 * @param {NodeList} btnActivateLightbox
 */


function lightbox(btnActivateLightbox) {
  var _iterator6 = _createForOfIteratorHelper(btnActivateLightbox),
      _step6;

  try {
    var _loop2 = function _loop2() {
      var lightbox = _step6.value;
      lightbox.addEventListener('click', function () {
        if (lightbox.dataset.type === 'img') {
          basiclightbox__WEBPACK_IMPORTED_MODULE_4__.create("<img src=\"" + lightbox.dataset.url + "\" alt=\"\">").show();
        }
      });
    };

    for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
      _loop2();
    }
  } catch (err) {
    _iterator6.e(err);
  } finally {
    _iterator6.f();
  }
}

$('#receiver_id').select2();
})();

/******/ })()
;