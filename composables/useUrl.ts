import config from '~/config.json';

export const useUrl = () => {
  function withoutTrailingSlash(path: string): string {
    return path.endsWith('/') ? path.slice(0, -1) : path;
  }

  function getVoieCyclablePath(line: number) {
    return `/${config.slug}-${line}`;
  }

  function getVoieCyclableRegex() {
    return new RegExp(`${config.slug}-(1[0-9]|[1-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-9]|7[0-9])\\b`);
  }

  return { withoutTrailingSlash, getVoieCyclablePath, getVoieCyclableRegex };
};
