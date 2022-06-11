#!/bin/sh
echo "Installing php_trie"

build_ext() {
  if test -d "php_trie"; then
    cd php_trie
    git clone https://github.com/Tessil/hat-trie.git
    phpize
    ./configure --with-hattrie="hat-trie/"
    make
    make install
    rm -rf hat-trie
  fi
}

if test ! -d "php_trie"; then
  if test ! -z $(which pecl); then
    echo "Installing from PECL"
    pecl download php_trie
    pecl bundle php_trie-0.1.2.tgz
    rm -rf *.tgz
    build_ext
  else
    echo "Installing from source"
    git clone https://github.com/ace411/php-trie-ext.git php_trie
    build_ext
  fi
else
  build_ext
fi
