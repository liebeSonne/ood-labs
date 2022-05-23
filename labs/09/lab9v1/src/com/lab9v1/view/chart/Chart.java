package com.lab9v1.view.chart;

import com.lab9v1.model.*;

import javax.swing.*;
import java.awt.*;

public class Chart extends JPanel implements DocumentObserver {

    ChartBackground background;
    ChartHarmonica harmonica;

    public Chart(ImmutableDocument document) {
        super();

        ChartBackgroundConfig backgroundConfig = new ChartBackgroundConfig();
        background = new ChartBackground(backgroundConfig);

        ChartHarmonicaConfig harmonicaConfig = new ChartHarmonicaConfig();
        harmonica = new ChartHarmonica(harmonicaConfig, document);

        this.add(harmonica);
        this.add(background);
    }

    public void update() {
        repaint();
    }

    @Override
    public void paintComponent(Graphics g) {
        background.setBounds(0,0, getWidth(), getHeight());
        harmonica.setBounds(0,0, getWidth(), getHeight());

        super.paintComponent(g);

        g.setColor(Color.WHITE);
        g.fillRect(0, 0, getWidth(), getHeight());

        Graphics2D g2 = (Graphics2D) g;

        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
    }

}
