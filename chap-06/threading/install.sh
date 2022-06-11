#!/bin/sh

build_ext() {
  if test -d "$1"; then
    cd $1
    phpize
    ./configure
    make
    make install
    cd ..
  fi
}

pthreads=pthreads
parallel=parallel

if test ! -d "$pthreads"; then
  if test ! -d "$parallel"; then
    git clone https://github.com/krakjoe/pthreads.git
    build_ext $pthreads

    git clone https://github.com/krakjoe/parallel.git
    build_ext $parallel
  else
    build_ext $pthreads
    build_ext $parallel
  fi
fi
