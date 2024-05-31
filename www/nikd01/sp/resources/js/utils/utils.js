export function getQueryParams(url) {
    if (!url) {
        return null;
    }
    const queryParams = new URLSearchParams(url.split('?')[1]);
    const params = {};
    queryParams.forEach((value, key) => {
        params[key] = value;
    });
    return params;
}
