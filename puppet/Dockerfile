FROM ubuntu:16.04

RUN apt-get update && apt-get install -y openssh-server nano mc screen python-simplejson python-apt puppetserver
RUN mkdir /var/run/sshd
RUN echo 'root:P@ssw0rd' | chpasswd
RUN sed -i 's/PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# SSH passwordless login
RUN sed -i '33 s/^##*//' /etc/ssh/sshd_config
ADD authorized_keys /root/.ssh/authorized_keys
RUN chmod 700 ~/.ssh
RUN chmod 644 ~/.ssh/authorized_keys

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]