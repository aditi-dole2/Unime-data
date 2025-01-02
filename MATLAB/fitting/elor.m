function [f,g]=elor(p)

global a b f g y x xi x1 ix iy np Plothandle shape1 shape2 shape33 sh yf 
global line1 line2 line3 line4 lineb lined pippo

g=0;

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
%p12 fondo
%p13 fondo

%%% Transform  FWHM into "standard deviat." necessary to define Gaussian lineshape (as in peakfit)
kk=(2*sqrt(2*log(2))); % conversion factor
p(2)=p(2)/kk;
r1=(x-p(3))./p(2);          % Reduced abscissa peak 1 low  BE
shape1=p(1).*(exp(-(0.5).*r1.*r1));

p(5)=p(5)/kk;
r2=(x-p(6))./p(5);          % Reduced abscissa peak 1 low  BE
shape2=p(4).*(exp(-(0.5).*r2.*r2));


r3=(x-p(10))./p(9);         % Reduced abscissa 1st peak low  BE
shape3=p(8).*((1-p(7)).*exp(-4.*log(2).*r3.*r3)+p(7)./(1+4.*r3.*r3));        % Symmetric low  BE
ef=exp(r3.*0.3.*exp((50-abs(p(11)))./20));    % Asymmetric low  BE
shape33=shape3+(p(8)-shape3).*ef.*(1-sign(r3))./2;            %  Total shape


sh=p(12).*x+p(13);
yf=shape1+shape2+shape33+sh;


f = sum((yf-y).^2);
g=0;

%  dummy=dummy+1;
%  if dummy == maxdum
%  subplot(Plothandle);


set(lined,'Ydata',y,'Marker','o','Color','green')
set(lineb,'Ydata',sh,'LineStyle','-','Color','red')
set(line1,'Ydata',shape1,'LineStyle','--','Color','magenta')
set(line2,'Ydata',shape2,'LineStyle','--','Color','red')
set(line3,'Ydata',shape33,'LineStyle','--','Color','red')
set(line4,'Ydata',yf,'LineStyle','-','Color','black')
pippo=p;
title(num2str(f,'%+6.4e'))

%  subplot(Devshandle);
%  set(liner,'Ydata',der,'Marker','o','Color','blue')
%  drawnow
%  dummy=0;
%  end

drawnow






