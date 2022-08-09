import styled, { css } from 'styled-components'
import media from 'styled-media-query'
import * as LogoStyles from '../Logo/style'
import * as DropdownItemStyles from '../DropdownItem/style'

export type NavBarProps = {
  logged?: boolean
  transparency?: boolean
  fixed?: boolean
}

export const WrapperClass = styled.header<NavBarProps>`
  .noScroll {
    ${({ theme, transparency }) => css`
      ${transparency
        ? `background-color: transparent;`
        : `background-color: ${theme.colors.contrast};`}
    `}
  }

  .scrolled {
    ${({ theme }) => css`
      background-color: ${theme.colors.contrast};
    `}
  }
`

export const Wrapper = styled.div<NavBarProps>`
  ${({ theme, fixed }) => css`
    ${fixed ? `position: fixed;` : ``}
    padding: ${theme.spacings.xxsmall} ${theme.spacings.xxxlarge};
    ${media.lessThan('large')`
      padding: ${theme.spacings.xxsmall} ${theme.spacings.small};
    `}
    width: 100%;
    align-items: center;
    display: flex;
    justify-content: space-between;
    transition: all 150ms 150ms ease-in;
  `}
`

export const WrapperLinks = styled.div`
  align-items: center;
  display: flex;
  ${({ theme }) => css`
    ${LogoStyles.Wrapper} {
      margin-right: ${theme.spacings.small};
    }
  `}
`

export const Links = styled.a`
  ${({ theme }) => css`
    color: ${theme.colors.white};
    margin-left: ${theme.spacings.medium};
  `}
  &:hover {
    cursor: pointer;
  }
  ${media.lessThan('medium')`
    display: none;
  `}
`

export const LinksMobile2 = styled.div`
  position: relative;
  text-align: center;
`

export const LinksMobile = styled.a`
  display: block;
  ${({ theme }) => css`
    color: ${theme.colors.white};
    margin-top: ${theme.spacings.medium};
    font-size: ${theme.font.sizes.large};
  `}
`

export const WrapperLinksMobile = styled.div`
  position: fixed;
  height: 100vh;
  top: 0;
  z-index: 1;
  width: 70%;
  transform: translateX(-100%);
  transform-origin: left center;
  transition: all 150ms 150ms ease-in;
  ${({ theme }) => css`
    background-color: ${theme.colors.contrast2};
    margin-left: -${theme.spacings.small};
  `}
`

export const HamburgerMenu = styled.button`
  background-color: transparent;
  border: 0;
  ${({ theme }) => css`
    margin-right: ${theme.spacings.small};
  `}
  &:hover {
    ${WrapperLinksMobile} {
      transform: translateX(0%);
      transition-timing-function: ease-out;
    }
  }
  ${media.greaterThan('medium')`
    display: none;
  `}
`

export const WrapperUser = styled.ul`
  align-items: center;
  display: flex;
  list-style: none;
`

export const User = styled.button<NavBarProps>`
  background-color: transparent;
  border: 0;
  height: 3rem;
  & > img {
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
  }
  ${({ theme, logged }) => css`
    padding: ${theme.spacings.xxsmall};
    display: flex;
    align-items: center;
    ${!logged && `width: 4rem;`};
  `}
`

export const Notify = styled.button`
  background-color: transparent;
  border: 0;
  height: 3rem;
  ${({ theme }) => css`
    padding: ${theme.spacings.xxsmall};
    margin: 0 ${theme.spacings.xsmall};
    display: flex;
    width: 3.5rem;
    align-items: center;
  `}
`

export const WrapperUserSubMenu = styled.ul`
  ${({ theme }) => css`
    background-color: ${theme.colors.contrast2};
    border-radius: ${theme.border.radius};
  `}
  position: absolute;
  right: 0;
  list-style: none;
  margin: 0;
  opacity: 0.25;
  top: calc(100% + 0.8rem);
  transform: rotateX(-90deg);
  transform-origin: top center;
  transition: all 150ms 150ms ease-in;
  ${DropdownItemStyles.SubMenuLinks}:first-child {
    ${({ theme }) => css`
      padding-top: ${theme.spacings.xxsmall};
    `}
  }
`

export const WrapperSearch = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1;
  height: 100vh;
  width: 100%;
  transform: scale(0, 0);
  transform-origin: center;
  transition: all 150ms 150ms ease-in;
  ${({ theme }) => css`
    background-color: ${theme.colors.contrast2};
  `}
`

export const WrapperSearchNav = styled.div``

export const ExitSearchButton = styled.div``

export const SearchTextFild = styled.div`
  ${media.lessThan('large')`
    display: none;
  `}
`

export const SearchButton = styled.button`
  background-color: transparent;
  border: 0;
  ${media.greaterThan('large')`
    display: none;
  `}
  &:hover {
    ${WrapperSearch} {
      transform: scale(1, 1);
      transition-timing-function: ease-out;
    }
  }
`

export const WrapperUserItem = styled.li`
  position: relative;
  &:hover {
    ${WrapperUserSubMenu} {
      opacity: 1;
      transform: rotateX(0deg);
      transition-timing-function: ease-out;
    }
  }
`