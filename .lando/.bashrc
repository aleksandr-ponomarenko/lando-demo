# Git promt
source ~/.git-prompt.sh
export GIT_PS1_SHOWDIRTYSTATE=true
export GIT_PS1_SHOWUPSTREAM=auto
export GIT_PS1_SHOWCOLORHINTS=true
#export PS1="\[\e]0;\u@\h: \w\a\]${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]$(__git_ps1 " (%s)")\$ "
export PROMPT_COMMAND='__git_ps1 "\[\033[01;32m\]\u@drupal9\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]" "\\\$ "'

source ~/.git-completion.bash
