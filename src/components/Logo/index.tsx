import * as S from './style'

export type LogoProps = {
  size?: 'xsmall' | 'small' | 'normal' | 'large'
  animateType?: 'infinit' | 'default'
  animate?: boolean
}

const Logo = ({
  size = 'normal',
  animate = false,
  animateType = 'default'
}: LogoProps) => {
  return (
    <S.Wrapper size={size} animate={animate} animateType={animateType}>
      <svg
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 170 180"
        aria-label="Logo da Tekkadan"
      >
        <path
          d="M69.05 141.16c-7.67 9.08-11.52 14.13-17.15 23.05 23.24-10.37 37.32-10.63 64.45 0-5.87-9.86-9.82-14.87-17.85-23.05a217.7 217.7 0 0 1-11.78-14.03c5.4-16.77 10.01-23.47 17.67-37.25-.02-.07 20.45-30.8 19.41-35.52-1.04-4.72-.46-6.58-9.88-20.27C104.13 19.86 97.46 12.57 83.08 1 71.11 12.7 64.76 19.93 54.15 34.1 48.33 41.4 44.1 48.46 44.1 54.35c0 5.9 10.57 21.42 19.75 35.52 7.46 14.2 11.7 22.12 17.67 37.25a216.84 216.84 0 0 1-12.47 14.03Z"
          fill="currentColor"
          stroke="currentColor"
        />
        <path
          d="m72.17 124.7-29.63 36.9c-1.48-14.3-2.78-22.01-6.06-35.16-5.16-16.43-8.99-25.3-17.85-40.37C11.85 76.3 8.21 71.55 2 64.4c15.41 1.35 23.6 4.13 36.73 13 15.61 11.52 22.96 22.18 33.44 47.3ZM95.39 123.95l30.87 36.97c1.55-14.34 2.9-22.07 6.31-35.24 5.37-16.45 9.37-25.33 18.6-40.44 7.06-9.78 10.86-14.54 17.33-21.7-16.06 1.36-24.6 4.14-38.27 13.02-16.27 11.55-23.93 22.23-34.84 47.39ZM106.32 171.83c0 .87-.5 1.77-1.56 2.65a15.2 15.2 0 0 1-4.6 2.4c-3.95 1.38-9.43 2.25-15.52 2.25-6.08 0-11.56-.87-15.51-2.26a15.2 15.2 0 0 1-4.6-2.39c-1.06-.88-1.56-1.78-1.56-2.65 0-.87.5-1.77 1.56-2.65 1.06-.88 2.62-1.7 4.6-2.39 3.95-1.39 9.43-2.25 15.51-2.25 6.09 0 11.57.86 15.52 2.25 1.98.7 3.54 1.51 4.6 2.4 1.06.87 1.56 1.77 1.56 2.64Z"
          fill="currentColor"
          stroke="currentColor"
        />
      </svg>
    </S.Wrapper>
  )
}

export default Logo