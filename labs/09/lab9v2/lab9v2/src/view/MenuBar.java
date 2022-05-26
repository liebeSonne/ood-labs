package view;

import controller.ShapeControllerInterface;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;

public class MenuBar extends JMenuBar {

    ShapeControllerInterface controller;

    CanvasPanel canvasPanel;

    public MenuBar(ShapeControllerInterface controller, CanvasPanel canvasPanel) {
        super();
        this.controller = controller;
        this.canvasPanel = canvasPanel;
        this.initComponents();
    }

    private void initComponents() {
        this.initMenuFile();
        this.initMenuHome();
        this.initMenuInsert();
        this.initMenuView();
        this.initMenuFormat();
    }

    private void initMenuFile() {
        JMenu menuFile = new JMenu("File");

        JMenuItem itemExit = new JMenuItem("Exit");
        itemExit.setMnemonic(KeyEvent.VK_Q);
        itemExit.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_Q, ActionEvent.CTRL_MASK));
        itemExit.setToolTipText("Exit application");
        itemExit.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent event) {
                System.exit(0);
            }
        });

        menuFile.add(itemExit);

        this.add(menuFile);
    }

    private void initMenuHome() {
        JMenu menuHome = new JMenu("Home");
        this.add(menuHome);
    }

    private void initMenuInsert() {
        JMenu menuInsert = new JMenu("Insert");

        JMenuItem itemRectangle = new JMenuItem("Rectangle");
        itemRectangle.setToolTipText("Insert Rectangle");
        itemRectangle.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addRectangle();
                drawCanvas();
            }
        });

        JMenuItem itemTriangle = new JMenuItem("Triangle");
        itemTriangle.setToolTipText("Insert Triangle");
        itemTriangle.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addTriangle();
                drawCanvas();
            }
        });

        JMenuItem itemEllipse = new JMenuItem("Ellipse");
        itemEllipse.setToolTipText("Insert Ellipse");
        itemEllipse.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.addEllipse();
                drawCanvas();
            }
        });

        menuInsert.add(itemRectangle);
        menuInsert.add(itemTriangle);
        menuInsert.add(itemEllipse);

        this.add(menuInsert);
    }

    private void initMenuView() {
        JMenu menuView = new JMenu("View");
        this.add(menuView);
    }

    private void initMenuFormat() {
        JMenu menuFormat = new JMenu("Format");
        this.add(menuFormat);
    }

    // @TODO - remove this method
    private void drawCanvas() {
        this.canvasPanel.redraw();
    }
}
