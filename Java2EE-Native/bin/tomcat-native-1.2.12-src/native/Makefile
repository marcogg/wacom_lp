#
# Licensed to the Apache Software Foundation (ASF) under one or more
# contributor license agreements.  See the NOTICE file distributed with
# this work for additional information regarding copyright ownership.
# The ASF licenses this file to You under the Apache License, Version 2.0
# (the "License"); you may not use this file except in compliance with
# the License.  You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#

#
# Top-level Makefile for TCNATIVE
#

CFLAGS = -g -O2 -DHAVE_POLLSET_WAKEUP
CPPFLAGS = 

# gets substituted into some targets
TCNATIVE_MAJOR_VERSION=1
TCNATIVE_DOTTED_VERSION=1.2.12
TCNATIVE_LIBTOOL_VERSION=2:12:2

srcdir = .


# this sucks, but it's the only way to add extra flags to the LT_COMPILE
INCLUDES = -g -O2 -DHAVE_POLLSET_WAKEUP   -I/home/wacom/www/Java2EE-Native/bin/tomcat-native-1.2.12-src/native/include -I/opt/jdk1.8.0_144//include -I/opt/jdk1.8.0_144//include/linux  -I/usr/local/apr/include/apr-1 
TCNATIVE_LDFLAGS = 
TCNATIVE_LIBS =  /usr/local/apr/lib/libapr-1.la -luuid -lrt -lcrypt  -lpthread -ldl

TARGET_LIB = libtcnative-${TCNATIVE_MAJOR_VERSION}.la
EXTRA_OS_LINK=
TCNATIVE_PCFILE = tcnative-$(TCNATIVE_MAJOR_VERSION).pc
INSTALL = /usr/bin/install -c
INSTALL_DATA = ${INSTALL} -m 644

TARGETS = $(TARGET_LIB)

# bring in rules.mk for standard functionality
include /home/wacom/www/Java2EE-Native/bin/tomcat-native-1.2.12-src/native/build/rules.mk
include /home/wacom/www/Java2EE-Native/bin/tomcat-native-1.2.12-src/native/build-outputs.mk

LINK          = $(LIBTOOL) $(LTFLAGS) --mode=link $(LT_LDFLAGS) $(COMPILE) -version-info $(TCNATIVE_LIBTOOL_VERSION) $(ALL_LDFLAGS) -o $@
CLEAN_SUBDIRS = test

CLEAN_TARGETS = .make.dirs
DISTCLEAN_TARGETS = config.cache config.log config.status libtool \
	build/rules.mk tcnative.pc
EXTRACLEAN_TARGETS = configure aclocal.m4 build-outputs.mk \
	build/apr_common.m4 build/find_apr.m4 build/install.sh \
	build/config.guess build/config.sub tcnative.spec

prefix=/home/wacom/www/Java2EE-Native
exec_prefix=${prefix}
bindir=${exec_prefix}/bin
libdir=${exec_prefix}/lib
includedir=${prefix}/include/apr-${TCNATIVE_MAJOR_VERSION}
top_srcdir=/home/wacom/www/Java2EE-Native/bin/tomcat-native-1.2.12-src/native
top_blddir=/home/wacom/www/Java2EE-Native/bin/tomcat-native-1.2.12-src/native


install: $(TARGET_LIB)
	$(APR_MKDIR) $(DESTDIR)$(includedir) $(DESTDIR)$(libdir)/pkgconfig \
		     $(DESTDIR)$(libdir) $(DESTDIR)$(bindir)
	$(INSTALL_DATA) tcnative.pc $(DESTDIR)$(libdir)/pkgconfig/$(TCNATIVE_PCFILE)
	list='$(INSTALL_SUBDIRS)'; for i in $$list; do \
		( cd $$i ; $(MAKE) DESTDIR=$(DESTDIR) install ); \
	done
	$(LIBTOOL) --mode=install $(INSTALL) -m 755 $(TARGET_LIB) $(DESTDIR)$(libdir)

$(TARGET_LIB): $(OBJECTS)
	$(LINK) -rpath $(libdir) $(OBJECTS)   /usr/local/apr/lib/libapr-1.la -luuid -lrt -lcrypt  -lpthread -ldl

check: $(TARGET_LIB)
	(cd test && $(MAKE) check)
