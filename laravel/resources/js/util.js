/**
 * @param {String} searchKey
 * @returns {String}
 */
export function getCookieValue(searchKey) {
  if (typeof searchKey === 'undefined') {
    return '';
  }

  const cookieValue = document.cookie.split(';').reduce((val, cookie) => {
    const [key, value] = cookie.split('=');
    if (key === searchKey) {
      val = value;
    }
    return val;
  }, '');

  return cookieValue;
}

export const OK = 200;
export const CREATED = 201;
export const NOT_FOUND = 404;
export const UNPROCESSABLE_ENTITY = 422;
export const INTERNAL_SERVER_ERROR = 500;
