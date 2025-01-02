clear all
close all
global a b f g y x x1 xi ix iy np Plothandle shape1 shape2 shape33 sh yf 
global line1 line2 line3 line4 lineb lined pippo

load s12_2c.txt
sam='s12_2c';
%------------------------------------ Select spectrum -----------------------------------------
eval(['xx=' sam '(:,1);']);eval(['yy=' sam '(:,2);']);
%yy=killint(yy,4);
%figure;ph1=plot(xx,yy,'go');
ix=[450 550]; % dati considerati per fit: limiti in x
%ix=[330 550]; % dati considerati per fit: limiti in x
idd=find(xx >=min(ix) & xx <=max(ix));
x=xx([idd]);y=yy([idd]);
y=y-min(y); % serve x portare il min(yy) a 0 per far funzionare il fit

set(gcf,'Name',sam)
%----------------------------------------------------------------------------------------------
hold on
Plothandle=plot(x,y,'y:','EraseMode','xor');
%XLim([417.5 1314])
xlabel('Raman shift  (cm^{-1})');ylabel('Counts');  
line1=line('xdata',x,'LineStyle','--','Color','blue','EraseMode','xor');
line2=line('xdata',x,'LineStyle','--','Color','blue','EraseMode','xor');
line3=line('xdata',x,'LineStyle','-','Color','black','EraseMode','xor');
line4=line('xdata',x,'LineStyle','-','Color','black','EraseMode','xor');
lined=line('xdata',x,'Marker','o','Color','green','EraseMode','xor');
lineb=line('xdata',x,'Marker','o','Color','green','EraseMode','xor');
set(gca,'FontName','Helvetica','FontSize',10);
set(lined,'Ydata',y,'Marker','o','Color','green') 
 
%p1  Peak 1 Height
%p2  FWHM 1
%p3  Peak 1 Position
%p4  Peak 2 Height
%p5  FWHM 2
%p6  Peak 2 Position
%p7  Lorentz content 3 0 < alpha < 1 
%p8  Peak Height 3
%p9  FWHM 3
%p10 Peak 1 Position 3
%p11 Asymmetry: must be > 0
%p12 linear back
%p13 linear back
                   
vlb=  [5   10.0   460   10    24.02   478   1   55     2    508   0.5  -1.0e2   -1.0e2]';
 p  = [70  20.0   465   20    30.02   480   1   200    10   510   15   -0.5 	   200]';
 vub= [139 37.6   464   40   45.02    504   1   900    20   523   24   1.0e2     1.0e2]';

np=length(p);
options=optimset('TolX',1e-5,'TolFun',1e-5,'TolCon',1e-5,'MaxIter',1e6,'MaxFunEvals',1e8);
tic
p = fmincon(@elor,p,[],[],[],[],vlb,vub,[],options);
toc
hold off
echo off

Plothandle=plot(x,y,'go',x,yf,'k-',x,shape1+sh,'--m', x,shape2+sh,'--r',x,shape33+sh,'--r',x,sh,'k.');
set(gca,'Fontsize',12);
xlabel('Raman shift (cm^{-1})','FontWeight','bold');
ylabel('Counts','FontWeight','bold');
title([sam '    f = ' num2str(f,'%+6.4e')],'FontWeight','bold')

  dp=[ 'p01 Peak 1 Height';
       'p02 FWHM 1       ';
       'p03 Peak 1 Posit ';
       'p04 Peak 2 Height';
       'p05 FWHM 2       ';
       'p06 Peak 2 Posit ';
       'p07 Lorentz cont3';
       'p08 Peak 3 Height';
       'p09 FWHM 3       ';
       'p10 Peak 3 Posit ';
       'p11 Asymmetry    ';
       'p12 costant      ';
       'p13 intercetta   '];

for i=1:length(p),
s(i,:)=sprintf('%+6.4e',p(i));
t(i,:)=[s(i,:) blanks(1) dp(i,:)];
end
text((max(x)+min(x))/2,(max(y)+min(y))/2,[t],'FontWeight','bold','Fontsize',12)
sam
t
f

% a(1)=(p(2)*p(1))./2
% a(2)=(p(5)*p(4))./2
% a(3)=(p(8)*p(9))./2*(pi.*p(7)+(1-p(7))*sqrt(pi./log(2)))
%      for i=1:length(a),
%     ar(i,:)=sprintf('%+6.3e',a(i));
%     tar(i,:)=[ar(i,:) blanks(1) 'Area' num2str(i)];
% end
% atr=sprintf('%+6.3e',sum(a));
% tat=[atr blanks(1) 'Area_Tot'];
% ss=['# Sil\{_x}' sam]
% res=strvcat(ss, t, tar, tat)
