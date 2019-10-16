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
