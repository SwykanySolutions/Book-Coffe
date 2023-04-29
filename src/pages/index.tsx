import Head from 'next/head'
import Footer from '../components/Footer'
import NavBar from '../components/NavBar'
import Carousel from '../components/Carousel'
import * as S from '../styles/home.style'
import { Pagination, Autoplay } from 'swiper'
import { Swiper, SwiperSlide } from 'swiper/react'
import 'swiper/css'
import 'swiper/css/pagination'
import { useRouter } from 'next/router'
import { useState } from 'react'
import { SliderService } from '../Services/SliderService'
import { Empty, Spin } from 'antd'
import Separator from '../components/Separator'
//import { useSelector } from 'react-redux'
//import { RootState } from '../store'
import { MangaChapterService } from '../Services/MangaChapterService'
import Link from 'next/link'
import moment from 'moment'
import { image } from '../shared/api.routes'
// eslint-disable-next-line @typescript-eslint/no-var-requires
const idLocale = require('moment/locale/pt-br')
moment.updateLocale('pt-br', idLocale)
import useSWR from 'swr'

const Home = () => {
  const router = useRouter()
  //const user = useSelector((state: RootState) => state.user)
  const [carouselIndex, setCarouselIndex] = useState(0)
  //const [lasts, setLasts] = useState([] as Array<chapterList>)
  const sliderService = new SliderService()
  const mangachapters = new MangaChapterService()
  const slider = useSWR('/slider', async () =>
    sliderService.getAllSlider().then((slider) => slider.data)
  )
  const lasts = useSWR('/lasts', async () =>
    mangachapters.getMangaLastsChapters().then((lasts) => lasts.data.data)
  )

  return (
    <>
      <Head>
        <title>Tekkadan | Home</title>
        <meta name="description" content="Generated by create next app" />
      </Head>
      <NavBar />
      <S.Wrapper>
        {slider.data ? (
          slider.data.length == 0 ? (
            <></>
          ) : (
            <Swiper
              style={{ marginBottom: '79px' }}
              modules={[Pagination, Autoplay]}
              spaceBetween={10}
              slidesPerView={1}
              autoplay={{
                delay: 4500,
                disableOnInteraction: false
              }}
              onClick={() => {
                router.push(
                  `/manga/${slider.data[carouselIndex].manga_over_view_id}`
                )
              }}
              onSlideChange={(swiper) => setCarouselIndex(swiper.activeIndex)}
              pagination={{ clickable: true }}
            >
              {slider.data.map((slider, i) => {
                return (
                  <SwiperSlide key={i}>
                    <Carousel
                      title={slider.title_photo}
                      background={slider.background_photo}
                    />
                  </SwiperSlide>
                )
              })}
            </Swiper>
          )
        ) : (
          <Spin tip="Carregando..." spinning={slider.data == undefined}>
            <div style={{ height: '30vw', width: '30%' }} />
          </Spin>
        )}
        {/* {user.logged && <Separator title="Continue lendo" />}
        <Separator title="Melhores da semana" /> */}
        <Separator title="Lançamentos" />
        <S.Table>
          <S.Lasts>
            {!lasts.data || lasts.data.length == 0 ? (
              <Empty className="result" image={Empty.PRESENTED_IMAGE_SIMPLE} />
            ) : (
              lasts.data.map((last, i) => {
                if (i <= 5) {
                  return (
                    <S.WrapperLast key={i}>
                      <Link href={`/manga/${last.manga_over_views.id}`}>
                        <S.LastMangaImage
                          src={image + last.manga_over_views.photo}
                        />
                      </Link>
                      <S.WrapperLastContent>
                        <Link href={`/manga/${last.manga_over_views.id}`}>
                          <S.LastTitle>
                            {last.manga_over_views.name}
                          </S.LastTitle>
                        </Link>
                        <Link href={`/manga/reader/${last.id}`}>
                          <S.LastCap>Capitulo {last.chapter}</S.LastCap>
                        </Link>
                        <S.LastTime>
                          {moment(last.created_at).fromNow()}
                        </S.LastTime>
                      </S.WrapperLastContent>
                    </S.WrapperLast>
                  )
                }
              })
            )}
          </S.Lasts>
          <S.Lasts id="item2">
            {!lasts.data || lasts.data.length <= 6 ? (
              <Empty className="result" image={Empty.PRESENTED_IMAGE_SIMPLE} />
            ) : (
              lasts.data.map((last, i) => {
                if (i > 5 && i <= 11) {
                  return (
                    <S.WrapperLast key={i}>
                      <Link href={`/manga/${last.manga_over_views.id}`}>
                        <S.LastMangaImage
                          src={image + last.manga_over_views.photo}
                        />
                      </Link>
                      <S.WrapperLastContent>
                        <Link href={`/manga/${last.manga_over_views.id}`}>
                          <S.LastTitle>
                            {last.manga_over_views.name}
                          </S.LastTitle>
                        </Link>
                        <Link href={`/manga/reader/${last.id}`}>
                          <S.LastCap>Capitulo {last.chapter}</S.LastCap>
                        </Link>
                        <S.LastTime>
                          {moment(last.created_at).fromNow()}
                        </S.LastTime>
                      </S.WrapperLastContent>
                    </S.WrapperLast>
                  )
                }
              })
            )}
          </S.Lasts>
          <S.Lasts id="item3">
            {!lasts.data || lasts.data.length <= 12 ? (
              <Empty className="result" image={Empty.PRESENTED_IMAGE_SIMPLE} />
            ) : (
              lasts.data.map((last, i) => {
                if (i > 11 && i <= 17) {
                  return (
                    <S.WrapperLast key={i}>
                      <Link href={`/manga/${last.manga_over_views.id}`}>
                        <S.LastMangaImage
                          src={image + last.manga_over_views.photo}
                        />
                      </Link>
                      <S.WrapperLastContent>
                        <Link href={`/manga/${last.manga_over_views.id}`}>
                          <S.LastTitle>
                            {last.manga_over_views.name}
                          </S.LastTitle>
                        </Link>
                        <Link href={`/manga/reader/${last.id}`}>
                          <S.LastCap>Capitulo {last.chapter}</S.LastCap>
                        </Link>
                        <S.LastTime>
                          {moment(last.created_at).fromNow()}
                        </S.LastTime>
                      </S.WrapperLastContent>
                    </S.WrapperLast>
                  )
                }
              })
            )}
          </S.Lasts>
        </S.Table>
      </S.Wrapper>
      <S.WrapperFooter>
        <Footer />
      </S.WrapperFooter>
    </>
  )
}

export default Home
