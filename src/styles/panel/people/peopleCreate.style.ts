import styled, { css } from 'styled-components'

export const WrapperButton = styled.div`
  margin-top: 10px;
  display: flex;
  width: 100%;
  justify-content: flex-end;
  margin-right: auto;
  margin-bottom: 10px;
`

export const Button = styled.div`
  width: 20%;
`

export const Wrapper = styled.div`
  width: 60%;
  margin-left: auto;
  margin-right: auto;
  margin-top: 10px;

  .filepond--panel-root {
    ${({ theme }) => css`
      background-color: ${theme.colors.contrast2};
    `}
  }

  .filepond--drop-label {
    ${({ theme }) => css`
      color: ${theme.colors.white};
    `}
  }

  .filepond--label-action {
    ${({ theme }) => css`
      color: ${theme.colors.white};
    `}
  }

  .filepond--drip-blob {
    ${({ theme }) => css`
      background-color: ${theme.colors.white3};
    `}
  }
  //auto generate

  .filepond--image-preview-markup {
    position: absolute;
    left: 0;
    top: 0;
  }
  .filepond--image-preview-wrapper {
    z-index: 2;
  }
  .filepond--image-preview-overlay {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    min-height: 5rem;
    max-height: 7rem;
    margin: 0;
    opacity: 0;
    z-index: 2;
    pointer-events: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  .filepond--image-preview-overlay svg {
    width: 100%;
    height: auto;
    color: inherit;
    max-height: inherit;
  }
  .filepond--image-preview-overlay-idle {
    mix-blend-mode: multiply;
    color: rgba(40, 40, 40, 0.85);
  }
  .filepond--image-preview-overlay-success {
    mix-blend-mode: normal;
    color: rgba(54, 151, 99, 1);
  }
  .filepond--image-preview-overlay-failure {
    mix-blend-mode: normal;
    color: rgba(196, 78, 71, 1);
  }
  /* disable for Safari as mix-blend-mode causes the overflow:hidden of the parent container to not work */
  @supports (-webkit-marquee-repetition: infinite) and
    ((-o-object-fit: fill) or (object-fit: fill)) {
    .filepond--image-preview-overlay-idle {
      mix-blend-mode: normal;
    }
  }
  .filepond--image-preview-wrapper {
    /* no interaction */
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

    /* have preview fill up all available space */
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    height: 100%;
    margin: 0;

    /* radius is .05em less to prevent the panel background color from shining through */
    border-radius: 0.45em;
    overflow: hidden;

    /* this seems to prevent Chrome from redrawing this layer constantly */
    background: rgba(0, 0, 0, 0.01);
  }
  .filepond--image-preview {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 1;
    display: flex; /* this aligns the graphic vertically if the panel is higher than the image */
    align-items: center;
    height: 100%;
    width: 100%;
    pointer-events: none;
    background: #222;

    /* will be animated */
    will-change: transform, opacity;
  }
  .filepond--image-clip {
    position: relative;
    overflow: hidden;
    margin: 0 auto;

    /* transparency indicator (currently only supports grid or basic color) */
  }
  .filepond--image-clip[data-transparency-indicator='grid'] img,
  .filepond--image-clip[data-transparency-indicator='grid'] canvas {
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg' fill='%23eee'%3E%3Cpath d='M0 0 H50 V50 H0'/%3E%3Cpath d='M50 50 H100 V100 H50'/%3E%3C/svg%3E");
    background-size: 1.25em 1.25em;
  }
  .filepond--image-bitmap,
  .filepond--image-vector {
    position: absolute;
    left: 0;
    top: 0;
    will-change: transform;
  }
  .filepond--root[data-style-panel-layout~='integrated']
    .filepond--image-preview-wrapper {
    border-radius: 0;
  }
  .filepond--root[data-style-panel-layout~='integrated']
    .filepond--image-preview {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--image-preview-wrapper {
    border-radius: 99999rem;
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--image-preview-overlay {
    top: auto;
    bottom: 0;
    -webkit-transform: scaleY(-1);
    transform: scaleY(-1);
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--file
    .filepond--file-action-button[data-align*='bottom']:not([data-align*='center']) {
    margin-bottom: 0.325em;
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--file
    [data-align*='left'] {
    left: calc(50% - 3em);
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--file
    [data-align*='right'] {
    right: calc(50% - 3em);
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--progress-indicator[data-align*='bottom'][data-align*='left'],
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--progress-indicator[data-align*='bottom'][data-align*='right'] {
    margin-bottom: calc(0.325em + 0.1875em);
  }
  .filepond--root[data-style-panel-layout~='circle']
    .filepond--progress-indicator[data-align*='bottom'][data-align*='center'] {
    margin-top: 0;
    margin-bottom: 0.1875em;
    margin-left: 0.1875em;
  }
`
export const Title = styled.h1`
  ${({ theme }) => css`
    font-size: ${theme.font.sizes.xlarge};
    color: ${theme.colors.white2};
  `}
`